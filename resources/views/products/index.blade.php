<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'Playfair Display',serif;font-size:1.4rem;font-weight:700;color:var(--text-dark);">Our Products</h2>
    </x-slot>

    <div style="padding:2.5rem 0;">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success fade-in-up">{{ session('success') }}</div>
            @endif

            {{-- Search + Filter --}}
            <form method="GET" action="{{ route('products.index') }}"
                  style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:2rem;align-items:center;">
                <div style="flex:1;min-width:200px;position:relative;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);width:16px;height:16px;color:#9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="form-input" style="padding-left:2.2rem;">
                </div>
                <select name="category" class="form-input" style="min-width:160px;width:auto;">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-gold" style="padding:0.6rem 1.4rem;">Search</button>
                @if(request('search')||request('category'))
                    <a href="{{ route('products.index') }}" class="btn-outline" style="padding:0.6rem 1.2rem;">Clear</a>
                @endif
            </form>

            {{-- Results count --}}
            <p style="font-size:0.85rem;color:var(--text-muted);margin-bottom:1.5rem;">
                {{ $products->count() }} product(s) found
                @if(request('search')) for "<strong style="color:var(--text-dark);">{{ request('search') }}</strong>"@endif
                @if(request('category')) in <strong style="color:var(--gold-dark);">{{ $categories->firstWhere('id',request('category'))?->name }}</strong>@endif
            </p>

            {{-- Products Grid --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">
                @forelse($products as $product)
                    <div class="product-card fade-in-up">
                        <a href="{{ route('products.show',$product) }}" class="product-img" style="display:block;">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:0.85rem;">No Image</div>
                            @endif
                        </a>
                        <div class="product-body">
                            <span class="product-category">{{ $product->category->name??'Uncategorized' }}</span>
                            <a href="{{ route('products.show',$product) }}" class="product-name">{{ $product->name }}</a>
                            <p class="product-desc">{{ $product->description }}</p>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:0.8rem;">
                                <span class="product-price">Rs. {{ number_format($product->price,0) }}</span>
                                <span class="product-stock">{{ $product->stock }} in stock</span>
                            </div>
                            @auth
                                <form action="{{ route('cart.add',$product) }}" method="POST" style="margin-top:0.8rem;">
                                    @csrf
                                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">🛒 Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn-outline" style="width:100%;margin-top:0.8rem;justify-content:center;">Login to Buy</a>
                            @endauth

                            {{-- Upload Image: SIRF ADMIN KO DIKHAYE --}}
                            @auth
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('products.edit',$product) }}"
                                       style="display:block;text-align:center;font-size:0.72rem;color:var(--text-muted);margin-top:0.5rem;text-decoration:none;">
                                        ⚙ Upload Image
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:4rem 0;">
                        <p style="color:var(--text-muted);font-size:1.1rem;">No products found.</p>
                        <a href="{{ route('products.index') }}" class="btn-gold" style="margin-top:1rem;display:inline-flex;">Show All</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>