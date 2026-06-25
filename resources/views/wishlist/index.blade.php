<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;">❤ My Wishlist</h2>
    </x-slot>
    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
            @if(session('success'))<div class="alert-success">{{ session('success') }}</div>@endif
            @if($wishlistItems->isEmpty())
                <div class="card" style="padding:4rem;text-align:center;">
                    <div style="font-size:3rem;margin-bottom:1rem;">💔</div>
                    <p style="color:var(--text-muted);font-size:1.1rem;margin-bottom:1.5rem;">Your wishlist is empty.</p>
                    <a href="{{ route('products.index') }}" class="btn-gold">Browse Products</a>
                </div>
            @else
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.5rem;">
                    @foreach($wishlistItems as $item)
                        <div class="product-card fade-in-up">
                            <a href="{{ route('products.show',$item->product) }}" class="product-img" style="display:block;height:200px;">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#d1d5db;">No Image</div>
                                @endif
                            </a>
                            <div class="product-body">
                                <span class="product-category">{{ $item->product->category->name??'Uncategorized' }}</span>
                                <a href="{{ route('products.show',$item->product) }}" class="product-name">{{ $item->product->name }}</a>
                                <p class="product-price">Rs. {{ number_format($item->product->price,0) }}</p>
                                <div style="display:flex;gap:0.6rem;margin-top:0.8rem;">
                                    <form action="{{ route('cart.add',$item->product) }}" method="POST" style="flex:1;">
                                        @csrf
                                        <button type="submit" class="btn-gold" style="width:100%;justify-content:center;padding:0.6rem;">Add to Cart</button>
                                    </form>
                                    <form action="{{ route('wishlist.remove',$item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="padding:0.6rem 0.9rem;border:1.5px solid #fca5a5;background:#fff5f5;color:#ef4444;border-radius:10px;cursor:pointer;font-size:1rem;">✕</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>