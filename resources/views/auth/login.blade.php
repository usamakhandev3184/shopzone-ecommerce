<x-guest-layout>

    @if (session('status'))
        <div class="status-alert">{{ session('status') }}</div>
    @endif

    <div class="auth-card">
        <h1 class="auth-title">Welcome Back!</h1>
        <p class="auth-subtitle">Sign in to your ShopZone account</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       class="form-input" required autofocus autocomplete="username"
                       placeholder="you@example.com">
                @if($errors->get('email'))
                    @foreach($errors->get('email') as $msg)
                        <p class="form-error">{{ $msg }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                       class="form-input" required autocomplete="current-password"
                       placeholder="Enter your password">
                @if($errors->get('password'))
                    @foreach($errors->get('password') as $msg)
                        <p class="form-error">{{ $msg }}</p>
                    @endforeach
                @endif
            </div>

            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-gold">Sign In →</button>
        </form>

        <div class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Create one free</a>
        </div>
    </div>

</x-guest-layout>