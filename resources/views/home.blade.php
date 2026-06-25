<x-app-layout>

    {{-- Hero --}}
    <section style="background:linear-gradient(135deg,#0F1C2E 0%,#1A2F4A 50%,#243B55 100%);min-height:88vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:5rem 1.5rem;position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 60% 40%,rgba(201,168,76,0.08) 0%,transparent 70%);"></div>
        <div style="position:relative;z-index:1;max-width:720px;">
            <div style="display:inline-block;background:rgba(201,168,76,0.12);border:1px solid rgba(201,168,76,0.35);color:#C9A84C;font-size:0.78rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:0.4rem 1.1rem;border-radius:999px;margin-bottom:1.5rem;">✦ Premium Online Shopping</div>
            <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2.5rem,6vw,4rem);font-weight:800;color:#ffffff;line-height:1.15;margin-bottom:1.25rem;">Shop Smarter,<br>Live <span style="color:#C9A84C;">Better</span></h1>
            <p style="font-size:1.1rem;color:rgba(255,255,255,0.65);line-height:1.7;margin-bottom:2.5rem;max-width:520px;margin-left:auto;margin-right:auto;">Discover thousands of premium products at unbeatable prices. From electronics to fashion — all in one place.</p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('products.index') }}" style="background:linear-gradient(135deg,#C9A84C,#9A7A2E);color:#0F1C2E;border:none;border-radius:12px;padding:0.9rem 2.2rem;font-size:1rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all 0.25s;">🛍 Shop Now</a>
                @guest
                    <a href="{{ route('register') }}" style="background:transparent;color:rgba(255,255,255,0.85);border:1.5px solid rgba(255,255,255,0.3);border-radius:12px;padding:0.9rem 2.2rem;font-size:1rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;">Create Free Account →</a>
                @endguest
            </div>
        </div>
    </section>

    {{-- Stats Bar --}}
    <div style="background:#0F1C2E;border-bottom:1px solid rgba(201,168,76,0.2);padding:1.25rem 1.5rem;">
        <div style="max-width:1280px;margin:0 auto;display:flex;flex-wrap:wrap;justify-content:center;gap:2.5rem;">
            <div style="text-align:center;"><div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:#C9A84C;">{{ $productCount }}+</div><div style="font-size:0.78rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.8px;margin-top:0.15rem;">Products</div></div>
            <div style="text-align:center;"><div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:#C9A84C;">{{ $categoryCount }}+</div><div style="font-size:0.78rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.8px;margin-top:0.15rem;">Categories</div></div>
            <div style="text-align:center;"><div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:#C9A84C;">100%</div><div style="font-size:0.78rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.8px;margin-top:0.15rem;">Secure Checkout</div></div>
            <div style="text-align:center;"><div style="font-family:'Playfair Display',serif;font-size:1.6rem;font-weight:700;color:#C9A84C;">24/7</div><div style="font-size:0.78rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:0.8px;margin-top:0.15rem;">Support</div></div>
        </div>
    </div>

    {{-- Categories --}}
    <section style="padding:5rem 1.5rem;">
        <div style="max-width:1280px;margin:0 auto;">
            <div style="text-align:center;margin-bottom:3rem;">
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3vw,2rem);font-weight:700;color:#0F1C2E;">Shop by Category</h2>
                <p style="color:#6B7280;font-size:0.95rem;margin-top:0.5rem;">Find exactly what you're looking for</p>
                <div style="width:48px;height:3px;background:linear-gradient(90deg,#C9A84C,#F0D080);border-radius:2px;margin:0.75rem auto 0;"></div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.25rem;">
                @foreach($categories as $cat)
                    @php $icons=['Electronics'=>'⚡','Clothing'=>'👗','Shoes'=>'👟','Mobile Accessories'=>'📱','Books'=>'📚','Sports'=>'🏆','Home'=>'🏠','Beauty'=>'💄']; $icon=$icons[$cat->name]??'🛍'; @endphp
                    <a href="{{ route('products.index',['category'=>$cat->id]) }}" style="background:linear-gradient(135deg,#0F1C2E,#1A2F4A);border-radius:16px;padding:2rem 1.5rem;text-align:center;text-decoration:none;border:1px solid rgba(201,168,76,0.15);transition:all 0.25s;display:block;" onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='rgba(201,168,76,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='rgba(201,168,76,0.15)'">
                        <div style="font-size:2.5rem;margin-bottom:0.75rem;">{{ $icon }}</div>
                        <div style="font-weight:700;color:#C9A84C;font-size:1rem;">{{ $cat->name }}</div>
                        <div style="font-size:0.8rem;color:rgba(255,255,255,0.45);margin-top:0.25rem;">{{ $cat->products_count }} products</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section style="padding:0 1.5rem 5rem;">
        <div style="max-width:1280px;margin:0 auto;">
            <div style="text-align:center;margin-bottom:3rem;">
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3vw,2rem);font-weight:700;color:#0F1C2E;">Featured Products</h2>
                <p style="color:#6B7280;font-size:0.95rem;margin-top:0.5rem;">Handpicked just for you</p>
                <div style="width:48px;height:3px;background:linear-gradient(90deg,#C9A84C,#F0D080);border-radius:2px;margin:0.75rem auto 0;"></div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.5rem;">
                @foreach($featuredProducts as $product)
                    <a href="{{ route('products.show',$product) }}" style="background:#fff;border-radius:16px;overflow:hidden;border:1px solid #E5E7EB;box-shadow:0 1px 4px rgba(0,0,0,0.07);transition:all 0.3s;display:flex;flex-direction:column;text-decoration:none;color:inherit;" onmouseover="this.style.boxShadow='0 8px 28px rgba(0,0,0,0.12)';this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 1px 4px rgba(0,0,0,0.07)';this.style.transform='translateY(0)'">
                        <div style="height:220px;overflow:hidden;background:#F3F4F6;">
                            @if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;">
                            @else<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:0.85rem;">No Image</div>@endif
                        </div>
                        <div style="padding:1.1rem;flex:1;display:flex;flex-direction:column;">
                            <div style="font-size:0.7rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#9A7A2E;margin-bottom:0.3rem;">{{ $product->category->name??'' }}</div>
                            <div style="font-size:1rem;font-weight:600;color:#0F1C2E;line-height:1.3;margin-bottom:0.4rem;">{{ $product->name }}</div>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:0.8rem;border-top:1px solid #F3F4F6;">
                                <span style="font-size:1.1rem;font-weight:800;color:#0F1C2E;">Rs. {{ number_format($product->price,0) }}</span>
                                <span style="background:linear-gradient(135deg,#C9A84C,#9A7A2E);color:#0F1C2E;border-radius:8px;padding:0.4rem 1rem;font-size:0.8rem;font-weight:700;">View →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div style="text-align:center;margin-top:2.5rem;">
                <a href="{{ route('products.index') }}" class="btn-gold" style="padding:0.9rem 2.5rem;font-size:1rem;">View All Products →</a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <div style="background:#0F1C2E;padding:4rem 1.5rem;">
        <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:2rem;">
            <div style="text-align:center;"><div style="font-size:2.2rem;margin-bottom:0.75rem;">🚚</div><h3 style="font-size:0.95rem;font-weight:700;color:#C9A84C;margin-bottom:0.4rem;">Fast Delivery</h3><p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.5;">Quick delivery to your doorstep</p></div>
            <div style="text-align:center;"><div style="font-size:2.2rem;margin-bottom:0.75rem;">🔒</div><h3 style="font-size:0.95rem;font-weight:700;color:#C9A84C;margin-bottom:0.4rem;">Secure Payment</h3><p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.5;">100% secure checkout with COD</p></div>
            <div style="text-align:center;"><div style="font-size:2.2rem;margin-bottom:0.75rem;">↩️</div><h3 style="font-size:0.95rem;font-weight:700;color:#C9A84C;margin-bottom:0.4rem;">Easy Returns</h3><p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.5;">Hassle-free returns within 7 days</p></div>
            <div style="text-align:center;"><div style="font-size:2.2rem;margin-bottom:0.75rem;">⭐</div><h3 style="font-size:0.95rem;font-weight:700;color:#C9A84C;margin-bottom:0.4rem;">Top Quality</h3><p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.5;">Only verified premium products</p></div>
        </div>
    </div>

</x-app-layout>