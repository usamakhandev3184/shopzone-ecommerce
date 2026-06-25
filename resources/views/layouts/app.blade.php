<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ShopZone') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gold:#C9A84C; --gold-light:#F0D080; --gold-dark:#9A7A2E;
            --navy:#0F1C2E; --navy-mid:#1A2F4A; --navy-light:#243B55;
            --white:#FFFFFF; --offwhite:#F8F7F4;
            --text-dark:#1A1A2E; --text-muted:#6B7280;
            --border:#E5E7EB;
            --shadow-sm:0 1px 3px rgba(0,0,0,0.08);
            --shadow-md:0 4px 16px rgba(0,0,0,0.10);
            --shadow-lg:0 8px 32px rgba(0,0,0,0.14);
            --radius:12px; --radius-lg:20px; --transition:0.25s ease;
        }
        *,*::before,*::after{box-sizing:border-box;}
        body{font-family:'Inter',sans-serif;background:var(--offwhite);color:var(--text-dark);min-height:100vh;-webkit-font-smoothing:antialiased;display:flex;flex-direction:column;}
        main{flex:1;}

        /* ── Navbar ── */
        nav.shopzone-nav{background:var(--navy);border-bottom:2px solid var(--gold-dark);position:sticky;top:0;z-index:100;box-shadow:0 2px 16px rgba(0,0,0,0.25);}
        nav.shopzone-nav .nav-logo{font-family:'Playfair Display',serif;color:var(--gold);font-size:1.4rem;font-weight:700;text-decoration:none;}
        nav.shopzone-nav .nav-link{color:rgba(255,255,255,0.75);font-size:0.875rem;font-weight:500;padding:0.5rem 0.25rem;text-decoration:none;border-bottom:2px solid transparent;transition:color var(--transition),border-color var(--transition);}
        nav.shopzone-nav .nav-link:hover,nav.shopzone-nav .nav-link.active{color:var(--gold);border-bottom-color:var(--gold);}
        nav.shopzone-nav .cart-btn{position:relative;color:rgba(255,255,255,0.8);transition:color var(--transition);}
        nav.shopzone-nav .cart-btn:hover{color:var(--gold);}
        nav.shopzone-nav .cart-badge{position:absolute;top:-6px;right:-6px;background:var(--gold);color:var(--navy);font-size:0.65rem;font-weight:700;border-radius:999px;min-width:18px;height:18px;display:flex;align-items:center;justify-content:center;padding:0 4px;}
        nav.shopzone-nav .user-btn{color:rgba(255,255,255,0.85);font-size:0.875rem;font-weight:500;background:var(--navy-light);border:1px solid rgba(201,168,76,0.3);border-radius:8px;padding:0.4rem 0.9rem;cursor:pointer;transition:all var(--transition);}
        nav.shopzone-nav .user-btn:hover{background:var(--navy-mid);border-color:var(--gold);color:var(--gold);}
        .nav-dropdown{background:var(--navy-mid);border:1px solid rgba(201,168,76,0.2);border-radius:var(--radius);box-shadow:var(--shadow-lg);min-width:180px;overflow:hidden;}
        .nav-dropdown a,.nav-dropdown button{display:block;width:100%;text-align:left;padding:0.6rem 1rem;font-size:0.875rem;color:rgba(255,255,255,0.75);text-decoration:none;background:transparent;border:none;cursor:pointer;transition:background var(--transition),color var(--transition);}
        .nav-dropdown a:hover,.nav-dropdown button:hover{background:rgba(201,168,76,0.1);color:var(--gold);}
        .page-header{background:var(--white);border-bottom:1px solid var(--border);padding:1.25rem 0;box-shadow:var(--shadow-sm);}
        .page-header h2{font-size:1.1rem;font-weight:600;color:var(--text-dark);}

        /* ── Cards ── */
        .card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow-sm);border:1px solid var(--border);transition:box-shadow var(--transition),transform var(--transition);}
        .card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);}

        /* ── Buttons ── */
        .btn-primary{background:linear-gradient(135deg,var(--navy) 0%,var(--navy-light) 100%);color:var(--gold);border:1px solid var(--gold-dark);border-radius:10px;padding:0.65rem 1.5rem;font-weight:600;font-size:0.9rem;cursor:pointer;transition:all var(--transition);display:inline-flex;align-items:center;gap:0.4rem;text-decoration:none;}
        .btn-primary:hover{box-shadow:0 4px 12px rgba(201,168,76,0.25);color:var(--gold-light);}
        .btn-gold{background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dark) 100%);color:var(--navy);border:none;border-radius:10px;padding:0.65rem 1.5rem;font-weight:700;font-size:0.9rem;cursor:pointer;transition:all var(--transition);display:inline-flex;align-items:center;gap:0.4rem;text-decoration:none;}
        .btn-gold:hover{background:linear-gradient(135deg,var(--gold-light) 0%,var(--gold) 100%);box-shadow:0 4px 12px rgba(201,168,76,0.35);transform:translateY(-1px);}
        .btn-outline{background:transparent;color:var(--text-muted);border:1px solid var(--border);border-radius:10px;padding:0.65rem 1.5rem;font-weight:500;font-size:0.9rem;cursor:pointer;transition:all var(--transition);display:inline-flex;align-items:center;gap:0.4rem;text-decoration:none;}
        .btn-outline:hover{border-color:var(--navy);color:var(--navy);}

        /* ── Product Cards ── */
        .product-card{background:var(--white);border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--border);box-shadow:var(--shadow-sm);transition:box-shadow var(--transition),transform var(--transition);display:flex;flex-direction:column;}
        .product-card:hover{box-shadow:var(--shadow-lg);transform:translateY(-4px);}
        .product-card .product-img{width:100%;height:220px;overflow:hidden;background:#f3f4f6;}
        .product-card .product-img img{width:100%;height:100%;object-fit:cover;transition:transform 0.4s ease;}
        .product-card:hover .product-img img{transform:scale(1.06);}
        .product-card .product-body{padding:1rem 1.1rem 1.2rem;flex:1;display:flex;flex-direction:column;}
        .product-card .product-category{font-size:0.7rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--gold-dark);margin-bottom:0.3rem;}
        .product-card .product-name{font-size:1rem;font-weight:600;color:var(--text-dark);text-decoration:none;transition:color var(--transition);line-height:1.3;}
        .product-card .product-name:hover{color:var(--gold-dark);}
        .product-card .product-desc{font-size:0.8rem;color:var(--text-muted);margin-top:0.3rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
        .product-card .product-price{font-size:1.2rem;font-weight:700;color:var(--navy);margin-top:auto;padding-top:0.8rem;}
        .product-card .product-stock{font-size:0.72rem;color:var(--text-muted);}

        /* ── Misc ── */
        .section-title{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:var(--text-dark);position:relative;display:inline-block;margin-bottom:1.5rem;}
        .section-title::after{content:'';position:absolute;bottom:-6px;left:0;width:48px;height:3px;background:linear-gradient(90deg,var(--gold),var(--gold-light));border-radius:2px;}
        .badge-gold{background:linear-gradient(135deg,rgba(201,168,76,0.15),rgba(201,168,76,0.08));color:var(--gold-dark);border:1px solid rgba(201,168,76,0.3);padding:0.2rem 0.7rem;border-radius:999px;font-size:0.7rem;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;}
        .alert-success{background:linear-gradient(135deg,#ecfdf5,#d1fae5);border:1px solid #6ee7b7;color:#065f46;border-radius:var(--radius);padding:0.8rem 1.2rem;font-size:0.875rem;font-weight:500;margin-bottom:1.5rem;}
        .form-input{width:100%;border:1.5px solid var(--border);border-radius:8px;padding:0.6rem 0.9rem;font-size:0.875rem;font-family:'Inter',sans-serif;transition:border-color var(--transition),box-shadow var(--transition);background:var(--white);color:var(--text-dark);outline:none;}
        .form-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.15);}
        @keyframes fadeInUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}
        .fade-in-up{animation:fadeInUp 0.4s ease forwards;}

        /* ── Footer ── */
        .site-footer{background:var(--navy);border-top:2px solid var(--gold-dark);padding:2.5rem 1.5rem;margin-top:auto;}
        .site-footer .footer-inner{max-width:1280px;margin:0 auto;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1.5rem;}
        .site-footer .footer-logo{font-family:'Playfair Display',serif;color:var(--gold);font-size:1.3rem;font-weight:700;text-decoration:none;}
        .site-footer .footer-links{display:flex;flex-wrap:wrap;gap:1.5rem;}
        .site-footer .footer-links a{color:rgba(255,255,255,0.5);font-size:0.82rem;text-decoration:none;transition:color var(--transition);}
        .site-footer .footer-links a:hover{color:var(--gold);}
        .site-footer .footer-copy{color:rgba(255,255,255,0.3);font-size:0.78rem;text-align:center;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(201,168,76,0.1);}
        ::-webkit-scrollbar{width:6px;}
        ::-webkit-scrollbar-track{background:var(--offwhite);}
        ::-webkit-scrollbar-thumb{background:var(--gold-dark);border-radius:3px;}
    </style>
</head>
<body>
    @include('layouts.navigation')

    @isset($header)
        <div class="page-header">
            <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">{{ $header }}</div>
        </div>
    @endisset

    <main>{{ $slot }}</main>

    {{-- Footer on all pages --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <a href="{{ route('home') }}" class="footer-logo">🛍 ShopZone</a>
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('products.index') }}">Products</a>
                @auth
                    <a href="{{ route('wishlist.index') }}">Wishlist</a>
                    <a href="{{ route('orders.history') }}">My Orders</a>
                    <a href="{{ route('cart.index') }}">Cart</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
        <div class="footer-copy" style="max-width:1280px;margin:0 auto;">
            © {{ date('Y') }} ShopZone — Built with ❤ using Laravel & LAMP Stack
        </div>
    </footer>
</body>
</html>