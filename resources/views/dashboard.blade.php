<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:700;color:var(--text-dark);">
            Welcome, {{ Auth::user()->name }}! 👋
        </h2>
    </x-slot>

    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">

            {{-- Quick Stats --}}
            @php
                $cartCount   = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
                $ordersCount = \App\Models\Order::where('user_id', Auth::id())->count();
                $wishCount   = \App\Models\Wishlist::where('user_id', Auth::id())->count();
            @endphp

            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
                <div class="card" style="padding:1.5rem;border-left:4px solid var(--gold);text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:var(--navy);">{{ $cartCount }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Items in Cart</p>
                </div>
                <div class="card" style="padding:1.5rem;border-left:4px solid #10b981;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#065f46;">{{ $ordersCount }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Total Orders</p>
                </div>
                <div class="card" style="padding:1.5rem;border-left:4px solid #ef4444;text-align:center;">
                    <p style="font-size:2rem;font-weight:800;color:#991b1b;">{{ $wishCount }}</p>
                    <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Wishlist Items</p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
                <a href="{{ route('products.index') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2rem;">🛍</span>
                    <div><p style="font-weight:700;color:var(--navy);">Browse Products</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Explore our collection</p></div>
                </a>
                <a href="{{ route('cart.index') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2rem;">🛒</span>
                    <div><p style="font-weight:700;color:var(--navy);">My Cart</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">{{ $cartCount }} items waiting</p></div>
                </a>
                <a href="{{ route('orders.history') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2rem;">📦</span>
                    <div><p style="font-weight:700;color:var(--navy);">My Orders</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Track your orders</p></div>
                </a>
                <a href="{{ route('wishlist.index') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2rem;">❤️</span>
                    <div><p style="font-weight:700;color:var(--navy);">Wishlist</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">{{ $wishCount }} saved items</p></div>
                </a>
                <a href="{{ route('profile.edit') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;">
                    <span style="font-size:2rem;">👤</span>
                    <div><p style="font-weight:700;color:var(--navy);">My Profile</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Update your info</p></div>
                </a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;text-decoration:none;border-color:rgba(201,168,76,0.3);">
                        <span style="font-size:2rem;">⚙️</span>
                        <div><p style="font-weight:700;color:var(--gold-dark);">Admin Panel</p><p style="font-size:0.82rem;color:var(--text-muted);margin-top:0.2rem;">Manage store</p></div>
                    </a>
                @endif
            </div>

            {{-- Recent Orders --}}
            @php $recentOrders = \App\Models\Order::with('items')->where('user_id',Auth::id())->latest()->take(3)->get(); @endphp
            @if($recentOrders->count() > 0)
                <div>
                    <h2 class="section-title">Recent Orders</h2>
                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        @foreach($recentOrders as $order)
                            @php $colors=['pending'=>'background:#fef3c7;color:#92400e;','processing'=>'background:#dbeafe;color:#1e40af;','completed'=>'background:#d1fae5;color:#065f46;','cancelled'=>'background:#fee2e2;color:#991b1b;']; @endphp
                            <div class="card" style="padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
                                <div style="display:flex;gap:2rem;flex-wrap:wrap;">
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Order</p><p style="font-weight:700;color:var(--navy);">#{{ $order->id }}</p></div>
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Total</p><p style="font-weight:700;color:var(--navy);">Rs. {{ number_format($order->total_amount,0) }}</p></div>
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Date</p><p style="font-weight:500;color:var(--text-dark);font-size:0.875rem;">{{ $order->created_at->format('d M Y') }}</p></div>
                                </div>
                                <span style="padding:0.3rem 0.9rem;border-radius:999px;font-size:0.75rem;font-weight:700;{{ $colors[$order->status]??'' }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin-top:1rem;">
                        <a href="{{ route('orders.history') }}" class="btn-outline" style="font-size:0.85rem;">View All Orders →</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>