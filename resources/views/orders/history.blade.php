<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">My Orders</h2>
    </x-slot>
    <div style="padding:2.5rem 0;">
        <div style="max-width:900px;margin:0 auto;padding:0 1.5rem;">
            @if($orders->isEmpty())
                <div class="card" style="padding:4rem;text-align:center;">
                    <div style="font-size:3rem;margin-bottom:1rem;">📦</div>
                    <p style="color:var(--text-muted);font-size:1.1rem;margin-bottom:1.5rem;">No orders yet.</p>
                    <a href="{{ route('products.index') }}" class="btn-gold">Start Shopping</a>
                </div>
            @else
                <div style="display:flex;flex-direction:column;gap:1.25rem;">
                    @foreach($orders as $order)
                        <div class="card fade-in-up" style="overflow:hidden;">
                            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;padding:1rem 1.5rem;background:var(--offwhite);border-bottom:1px solid var(--border);">
                                <div style="display:flex;gap:2rem;flex-wrap:wrap;">
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Order ID</p><p style="font-weight:700;color:var(--navy);">#{{ $order->id }}</p></div>
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Date</p><p style="font-weight:600;color:var(--text-dark);font-size:0.875rem;">{{ $order->created_at->format('d M Y') }}</p></div>
                                    <div><p style="font-size:0.72rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;">Total</p><p style="font-weight:700;color:var(--navy);">Rs. {{ number_format($order->total_amount,0) }}</p></div>
                                </div>
                                @php $colors=['pending'=>'background:#fef3c7;color:#92400e;','processing'=>'background:#dbeafe;color:#1e40af;','completed'=>'background:#d1fae5;color:#065f46;','cancelled'=>'background:#fee2e2;color:#991b1b;']; @endphp
                                <span style="padding:0.3rem 0.9rem;border-radius:999px;font-size:0.75rem;font-weight:700;{{ $colors[$order->status]??'' }}">{{ ucfirst($order->status) }}</span>
                            </div>
                            <div style="padding:1rem 1.5rem;">
                                @foreach($order->items as $item)
                                    <div style="display:flex;align-items:center;justify-content:space-between;padding:0.6rem 0;border-bottom:1px solid var(--border);">
                                        <div style="display:flex;align-items:center;gap:0.75rem;">
                                            <div style="width:44px;height:44px;border-radius:8px;overflow:hidden;background:var(--offwhite);flex-shrink:0;">
                                                @if($item->product&&$item->product->image)<img src="{{ asset('storage/'.$item->product->image) }}" style="width:100%;height:100%;object-fit:cover;">@endif
                                            </div>
                                            <div>
                                                <p style="font-size:0.875rem;font-weight:600;color:var(--text-dark);">{{ $item->product_name }}</p>
                                                <p style="font-size:0.75rem;color:var(--text-muted);">Qty: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                        <p style="font-size:0.875rem;font-weight:700;color:var(--navy);">Rs. {{ number_format($item->price*$item->quantity,0) }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div style="padding:0.75rem 1.5rem;background:var(--offwhite);font-size:0.8rem;color:var(--text-muted);display:flex;gap:1.5rem;">
                                <span>📍 {{ $order->address }}</span>
                                <span>📞 {{ $order->phone }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>