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
        *,*::before,*::after{box-sizing:border-box;}
        body{
            font-family:'Inter',sans-serif;
            margin:0; padding:0;
            min-height:100vh;
            background: linear-gradient(135deg, #0F1C2E 0%, #1A2F4A 50%, #243B55 100%);
            display:flex; align-items:center; justify-content:center;
            -webkit-font-smoothing:antialiased;
        }
        .auth-wrapper{
            width:100%; max-width:460px;
            padding:1.5rem;
        }
        .auth-logo{
            text-align:center;
            margin-bottom:2rem;
        }
        .auth-logo a{
            font-family:'Playfair Display',serif;
            font-size:2rem; font-weight:700;
            color:#C9A84C; text-decoration:none;
            letter-spacing:0.5px;
        }
        .auth-logo p{
            color:rgba(255,255,255,0.5);
            font-size:0.85rem; margin-top:0.4rem;
        }
        .auth-card{
            background:#ffffff;
            border-radius:20px;
            box-shadow:0 20px 60px rgba(0,0,0,0.3);
            padding:2.5rem;
            border-top:4px solid #C9A84C;
        }
        .auth-title{
            font-family:'Playfair Display',serif;
            font-size:1.5rem; font-weight:700;
            color:#0F1C2E;
            margin-bottom:0.4rem;
        }
        .auth-subtitle{
            font-size:0.85rem; color:#6B7280;
            margin-bottom:2rem;
        }
        .form-group{ margin-bottom:1.1rem; }
        .form-label{
            display:block; font-size:0.82rem;
            font-weight:600; color:#374151;
            margin-bottom:0.4rem;
        }
        .form-input{
            width:100%;
            border:1.5px solid #E5E7EB;
            border-radius:10px;
            padding:0.65rem 0.9rem;
            font-size:0.875rem;
            font-family:'Inter',sans-serif;
            color:#1A1A2E;
            outline:none;
            transition:border-color 0.25s, box-shadow 0.25s;
            background:#fff;
        }
        .form-input:focus{
            border-color:#C9A84C;
            box-shadow:0 0 0 3px rgba(201,168,76,0.15);
        }
        .form-error{
            font-size:0.78rem; color:#dc2626;
            margin-top:0.3rem;
        }
        .btn-gold{
            width:100%;
            background:linear-gradient(135deg,#C9A84C 0%,#9A7A2E 100%);
            color:#0F1C2E;
            border:none; border-radius:10px;
            padding:0.8rem 1.5rem;
            font-weight:700; font-size:0.95rem;
            font-family:'Inter',sans-serif;
            cursor:pointer;
            transition:all 0.25s;
            margin-top:0.5rem;
        }
        .btn-gold:hover{
            background:linear-gradient(135deg,#F0D080 0%,#C9A84C 100%);
            box-shadow:0 4px 15px rgba(201,168,76,0.35);
            transform:translateY(-1px);
        }
        .auth-footer{
            text-align:center;
            margin-top:1.5rem;
            font-size:0.85rem; color:#6B7280;
        }
        .auth-footer a{
            color:#9A7A2E; font-weight:600;
            text-decoration:none;
        }
        .auth-footer a:hover{ color:#C9A84C; }
        .divider{
            border:none; border-top:1px solid #E5E7EB;
            margin:1.5rem 0;
        }
        .remember-row{
            display:flex; align-items:center;
            justify-content:space-between;
            margin-bottom:1rem;
        }
        .remember-label{
            display:flex; align-items:center; gap:0.5rem;
            font-size:0.83rem; color:#6B7280; cursor:pointer;
        }
        .remember-label input{ accent-color:#C9A84C; width:15px; height:15px; }
        .forgot-link{
            font-size:0.83rem; color:#9A7A2E;
            font-weight:600; text-decoration:none;
        }
        .forgot-link:hover{ color:#C9A84C; }
        /* Status alert */
        .status-alert{
            background:#d1fae5; border:1px solid #6ee7b7;
            color:#065f46; border-radius:8px;
            padding:0.65rem 0.9rem;
            font-size:0.82rem; margin-bottom:1rem;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-logo">
            <a href="{{ route('products.index') }}">🛍 ShopZone</a>
            <p>Premium Shopping Experience</p>
        </div>
        {{ $slot }}
    </div>
</body>
</html>