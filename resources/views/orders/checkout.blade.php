<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">Checkout</h2>
    </x-slot>
    <div style="padding:2.5rem 0;">
        <div style="max-width:1100px;margin:0 auto;padding:0 1.5rem;">
            <div style="display:flex;flex-wrap:wrap;gap:2rem;">
                {{-- Shipping Form --}}
                <div style="flex:1;min-width:280px;">
                    <div class="card" style="padding:2rem;">
                        <h3 style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:var(--navy);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:2px solid var(--gold);display:inline-block;">Shipping Details</h3>
                        <form action="{{ route('orders.place') }}" method="POST">
                            @csrf
                            <div style="margin-bottom:1.1rem;">
                                <label style="display:block;font-size:0.85rem;font-weight:600;color:var(--text-dark);margin-bottom:0.4rem;">Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name',Auth::user()->name) }}" class="form-input">
                                @error('full_name')<p style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;">{{ $message }}</p>@enderror
                            </div>
                            <div style="margin-bottom:1.1rem;">
                                <label style="display:block;font-size:0.85rem;font-weight:600;color:var(--text-dark);margin-bottom:0.4rem;">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+92 300 0000000" class="form-input">
                                @error('phone')<p style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;">{{ $message }}</p>@enderror
                            </div>
                            <div style="margin-bottom:1.5rem;">
                                <label style="display:block;font-size:0.85rem;font-weight:600;color:var(--text-dark);margin-bottom:0.4rem;">Delivery Address</label>
                                <textarea name="address" rows="3" placeholder="House #, Street, City" class="form-input">{{ old('address') }}</textarea>
                                @error('address')<p style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;">{{ $message }}</p>@enderror
                            </div>
                            <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(201,168,76,0.04));border:1px solid rgba(201,168,76,0.3);border-radius:10px;padding:1rem;margin-bottom:1.5rem;">
                                <p style="font-size:0.85rem;font-weight:700;color:var(--gold-dark);">💳 Payment Method</p>
                                <p style="font-size:0.85rem;color:var(--text-muted);margin-top:0.25rem;">Cash on Delivery (COD)</p>
                            </div>
                            <button type="submit" class="btn-gold" style="width:100%;justify-content:center;padding:0.9rem;font-size:1rem;">
                                Place Order — Rs. {{ number_format($total,0) }}
                            </button>
                        </form>
                    </div>
                </div>
                {{-- Order Summary --}}
                <div style="width:320px;flex-shrink:0;">
                    <div class="card" style="padding:1.5rem;">
                        <h3 style="font-size:0.95rem;font-weight:700;color:var(--navy);margin-bottom:1.25rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">Order Summary</h3>
                        @foreach($cartItems as $item)
                            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
                                <div style="width:48px;height:48px;border-radius:8px;overflow:hidden;background:var(--offwhite);flex-shrink:0;">
                                    @if($item->product->image)<img src="{{ asset('storage/'.$item->product->image) }}" style="width:100%;height:100%;object-fit:cover;">@endif
                                </div>
                                <div style="flex:1;">
                                    <p style="font-size:0.85rem;font-weight:600;color:var(--text-dark);">{{ $item->product->name }}</p>
                                    <p style="font-size:0.75rem;color:var(--text-muted);">Qty: {{ $item->quantity }}</p>
                                </div>
                                <span style="font-size:0.875rem;font-weight:700;color:var(--navy);">Rs. {{ number_format($item->product->price*$item->quantity,0) }}</span>
                            </div>
                        @endforeach
                        <div style="border-top:2px solid var(--border);padding-top:1rem;margin-top:0.5rem;display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-weight:700;color:var(--text-dark);">Total</span>
                            <span style="font-size:1.2rem;font-weight:800;color:var(--navy);">Rs. {{ number_format($total,0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>