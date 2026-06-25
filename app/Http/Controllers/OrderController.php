<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show checkout page with only selected items from session.
     */
    public function checkout()
    {
        $selectedIds = session('selected_cart_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')
                ->with('success', 'Please select items to checkout.');
        }

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    /**
     * Place the order for selected items only.
     */
    public function placeOrder(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:500',
        ]);

        $selectedIds = session('selected_cart_items', []);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::transaction(function () use ($request, $cartItems, $total) {
            $order = Order::create([
                'user_id'      => Auth::id(),
                'total_amount' => $total,
                'status'       => 'pending',
                'full_name'    => $request->full_name,
                'phone'        => $request->phone,
                'address'      => $request->address,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity'     => $item->quantity,
                    'price'        => $item->product->price,
                ]);
            }

            // Remove only the selected items from cart
            CartItem::where('user_id', Auth::id())
                ->whereIn('id', $cartItems->pluck('id'))
                ->delete();
        });

        // Clear session
        session()->forget('selected_cart_items');

        return redirect()->route('orders.success')
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Show order success page.
     */
    public function success()
    {
        return view('orders.success');
    }
}