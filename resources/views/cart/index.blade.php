<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">🛒 Your Cart</h2>
    </x-slot>
    <div style="padding:2.5rem 0;">
        <div style="max-width:900px;margin:0 auto;padding:0 1.5rem;">
            @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif

            @if($cartItems->isEmpty())
                <div class="card" style="padding:4rem;text-align:center;">
                    <div style="font-size:3.5rem;margin-bottom:1rem;">🛒</div>
                    <p style="color:var(--text-muted);font-size:1.1rem;margin-bottom:1.5rem;">Your cart is empty.</p>
                    <a href="{{ route('products.index') }}" class="btn-gold">Browse Products</a>
                </div>
            @else
                @foreach($cartItems as $item)
                    <form id="updateForm{{ $item->id }}" action="{{ route('cart.update',$item) }}" method="POST" style="display:none;">@csrf @method('PATCH')<input type="number" name="quantity" id="qtyInput{{ $item->id }}" value="{{ $item->quantity }}"></form>
                    <form id="removeForm{{ $item->id }}" action="{{ route('cart.remove',$item) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                @endforeach

                <form action="{{ route('cart.proceed') }}" method="POST" id="cartForm">
                    @csrf
                    <div class="card" style="overflow:hidden;margin-bottom:1rem;">
                        {{-- Select All --}}
                        <div style="display:flex;align-items:center;gap:0.75rem;padding:0.9rem 1.25rem;background:var(--offwhite);border-bottom:1px solid var(--border);">
                            <input type="checkbox" id="selectAll" style="width:17px;height:17px;cursor:pointer;accent-color:var(--gold);">
                            <label for="selectAll" style="font-size:0.875rem;font-weight:600;color:var(--text-dark);cursor:pointer;">Select All Items</label>
                        </div>

                        @foreach($cartItems as $item)
                            <div class="cart-row" style="display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;border-bottom:1px solid var(--border);"
                                 data-price="{{ $item->product->price }}" data-quantity="{{ $item->quantity }}" data-id="{{ $item->id }}">
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}"
                                       class="item-checkbox" style="width:17px;height:17px;cursor:pointer;accent-color:var(--gold);flex-shrink:0;">
                                <div style="width:72px;height:72px;border-radius:10px;overflow:hidden;background:var(--offwhite);flex-shrink:0;">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" style="width:100%;height:100%;object-fit:cover;">
                                    @endif
                                </div>
                                <div style="flex:1;">
                                    <p style="font-weight:600;color:var(--text-dark);font-size:0.95rem;">{{ $item->product->name }}</p>
                                    <p style="font-size:0.82rem;color:var(--text-muted);">Rs. {{ number_format($item->product->price,0) }} each</p>
                                </div>
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <input type="number" value="{{ $item->quantity }}" min="1" max="99"
                                           class="qty-input form-input" style="width:60px;text-align:center;padding:0.4rem;"
                                           data-id="{{ $item->id }}">
                                    <button type="button" onclick="updateQty({{ $item->id }})"
                                            style="font-size:0.78rem;color:var(--gold-dark);background:none;border:none;cursor:pointer;font-weight:600;">Update</button>
                                </div>
                                <div style="text-align:right;min-width:90px;">
                                    <span style="font-weight:700;color:var(--navy);font-size:0.95rem;">Rs. {{ number_format($item->product->price*$item->quantity,0) }}</span>
                                </div>
                                <button type="button" onclick="removeItem({{ $item->id }})"
                                        style="color:#ef4444;background:none;border:none;cursor:pointer;font-size:1.1rem;padding:0.25rem;">✕</button>
                            </div>
                        @endforeach

                        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.25rem;background:var(--offwhite);">
                            <div>
                                <p style="font-size:0.8rem;color:var(--text-muted);">Selected Items Total:</p>
                                <p style="font-size:1.4rem;font-weight:800;color:var(--navy);">Rs. <span id="selectedTotal">0</span></p>
                            </div>
                            <button type="submit" id="checkoutBtn" disabled class="btn-gold"
                                    style="opacity:0.4;cursor:not-allowed;">
                                Proceed to Checkout →
                            </button>
                        </div>
                    </div>
                </form>
                <div style="text-align:center;margin-top:1rem;">
                    <a href="{{ route('products.index') }}" style="font-size:0.875rem;color:var(--gold-dark);text-decoration:none;font-weight:500;">← Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
    <script>
        const checkboxes=document.querySelectorAll('.item-checkbox');
        const selectAll=document.getElementById('selectAll');
        const totalEl=document.getElementById('selectedTotal');
        const btn=document.getElementById('checkoutBtn');
        function updateTotal(){let t=0,any=false;checkboxes.forEach(cb=>{if(cb.checked){any=true;const r=cb.closest('.cart-row');t+=parseFloat(r.dataset.price)*parseInt(r.dataset.quantity);}});if(totalEl)totalEl.textContent=t.toLocaleString('en-PK');if(btn){btn.disabled=!any;btn.style.opacity=any?'1':'0.4';btn.style.cursor=any?'pointer':'not-allowed';}}
        if(checkboxes)checkboxes.forEach(cb=>cb.addEventListener('change',updateTotal));
        if(selectAll)selectAll.addEventListener('change',function(){checkboxes.forEach(cb=>cb.checked=this.checked);updateTotal();});
        if(document.getElementById('cartForm'))document.getElementById('cartForm').addEventListener('submit',function(e){const any=[...checkboxes].some(cb=>cb.checked);if(!any){e.preventDefault();alert('Please select at least one item.');}});
        function updateQty(id){const input=document.querySelector(`.qty-input[data-id="${id}"]`);document.getElementById(`qtyInput${id}`).value=input.value;document.getElementById(`updateForm${id}`).submit();}
        function removeItem(id){if(confirm('Remove this item?'))document.getElementById(`removeForm${id}`).submit();}
    </script>
</x-app-layout>