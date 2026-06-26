<nav class="shopzone-nav" x-data="{ open: false }">
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
        <div style="display:flex;align-items:center;justify-content:space-between;height:64px;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="nav-logo">🛍 ShopZone</a>

            {{-- Desktop Links — always flex on desktop --}}
            <div style="display:none;" id="desktopNav">
                <div style="display:flex;align-items:center;gap:1.75rem;">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    @endauth
                    <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a>
                    @auth
                        <a href="{{ route('wishlist.index') }}" class="nav-link {{ request()->routeIs('wishlist.*') ? 'active' : '' }}">❤ Wishlist</a>
                        <a href="{{ route('orders.history') }}" class="nav-link {{ request()->routeIs('orders.history') ? 'active' : '' }}">My Orders</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">⚙ Admin</a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Right Side --}}
            <div style="display:none;" id="desktopRight">
                <div style="display:flex;align-items:center;gap:1.2rem;">
                    @auth
                        @php $cartCount = \App\Models\CartItem::where('user_id',Auth::id())->sum('quantity'); @endphp
                        <a href="{{ route('cart.index') }}" class="cart-btn" style="display:inline-flex;position:relative;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @if($cartCount > 0)<span class="cart-badge">{{ $cartCount }}</span>@endif
                        </a>
                        <div style="position:relative;" x-data="{ dropdown:false }">
                            <button @click="dropdown=!dropdown" class="user-btn">
                                {{ Auth::user()->name }}
                                <svg style="width:13px;height:13px;display:inline;margin-left:4px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                            <div x-show="dropdown" @click.away="dropdown=false"
                                 style="position:absolute;right:0;top:calc(100% + 8px);z-index:200;"
                                 class="nav-dropdown">
                                <a href="{{ route('home') }}">🏠 Home</a>
                                <a href="{{ route('dashboard') }}">📊 Dashboard</a>
                                <a href="{{ route('profile.edit') }}">👤 Profile</a>
                                <a href="{{ route('orders.history') }}">📦 My Orders</a>
                                <a href="{{ route('wishlist.index') }}">❤ Wishlist</a>
                                @if(Auth::user()->is_admin)<a href="{{ route('admin.dashboard') }}">⚙ Admin Panel</a>@endif
                                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">🚪 Log Out</button></form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.8);font-size:0.85rem;font-weight:500;text-decoration:none;border:1px solid rgba(201,168,76,0.3);border-radius:8px;padding:0.4rem 1rem;background:#1A2F4A;">Sign In</a>
                        <a href="{{ route('register') }}" style="background:linear-gradient(135deg,#C9A84C,#9A7A2E);color:#0F1C2E;border:none;border-radius:8px;padding:0.4rem 1rem;font-size:0.85rem;font-weight:700;text-decoration:none;">Join Free</a>
                    @endauth
                </div>
            </div>

            {{-- Mobile Hamburger --}}
            <button id="mobileMenuBtn" onclick="toggleMobileMenu()"
                    style="color:rgba(255,255,255,0.8);background:none;border:none;cursor:pointer;padding:0.5rem;display:none;">
                <svg style="width:24px;height:24px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" style="display:none;background:#1A2F4A;border-top:1px solid rgba(201,168,76,0.2);padding:1rem 1.5rem;">
        <a href="{{ route('home') }}" class="nav-link" style="display:block;padding:0.6rem 0;">🏠 Home</a>
        @auth
            <a href="{{ route('dashboard') }}" class="nav-link" style="display:block;padding:0.6rem 0;">📊 Dashboard</a>
        @endauth
        <a href="{{ route('products.index') }}" class="nav-link" style="display:block;padding:0.6rem 0;">Products</a>
        @auth
            <a href="{{ route('wishlist.index') }}" class="nav-link" style="display:block;padding:0.6rem 0;">❤ Wishlist</a>
            <a href="{{ route('orders.history') }}" class="nav-link" style="display:block;padding:0.6rem 0;">My Orders</a>
            <a href="{{ route('cart.index') }}" class="nav-link" style="display:block;padding:0.6rem 0;">🛒 Cart</a>
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="nav-link" style="display:block;padding:0.6rem 0;">⚙ Admin</a>
            @endif
            <div style="border-top:1px solid rgba(255,255,255,0.1);margin:0.8rem 0;padding-top:0.8rem;">
                <p style="color:rgba(255,255,255,0.5);font-size:0.8rem;margin-bottom:0.5rem;">{{ Auth::user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="nav-link" style="display:block;padding:0.4rem 0;">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="display:block;padding:0.4rem 0;background:none;border:none;cursor:pointer;width:100%;text-align:left;">Log Out</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="nav-link" style="display:block;padding:0.6rem 0;">Sign In</a>
            <a href="{{ route('register') }}" class="nav-link" style="display:block;padding:0.6rem 0;">Join Free</a>
        @endauth
    </div>

    <script>
        // Responsive navbar without Tailwind breakpoints
        function handleResize() {
            const isDesktop = window.innerWidth >= 640;
            document.getElementById('desktopNav').style.display    = isDesktop ? 'block' : 'none';
            document.getElementById('desktopRight').style.display  = isDesktop ? 'block' : 'none';
            document.getElementById('mobileMenuBtn').style.display = isDesktop ? 'none' : 'block';
            if (isDesktop) {
                document.getElementById('mobileMenu').style.display = 'none';
            }
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }

        // Run on load and resize
        handleResize();
        window.addEventListener('resize', handleResize);
    </script>
</nav>
