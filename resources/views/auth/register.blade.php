<x-guest-layout>

    <div class="auth-card">
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Join ShopZone — it's free!</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" name="name"
                       value="{{ old('name') }}"
                       class="form-input" required autofocus autocomplete="name"
                       placeholder="Usama Khan">
                @if($errors->get('name'))
                    @foreach($errors->get('name') as $msg)
                        <p class="form-error">{{ $msg }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       class="form-input" required autocomplete="username"
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
                       class="form-input" required autocomplete="new-password"
                       placeholder="Min. 8 characters">
                @if($errors->get('password'))
                    @foreach($errors->get('password') as $msg)
                        <p class="form-error">{{ $msg }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password"
                       name="password_confirmation"
                       class="form-input" required autocomplete="new-password"
                       placeholder="Repeat your password">
                @if($errors->get('password_confirmation'))
                    @foreach($errors->get('password_confirmation') as $msg)
                        <p class="form-error">{{ $msg }}</p>
                    @endforeach
                @endif
            </div>

            <button type="submit" class="btn-gold">Create Account →</button>
        </form>

        <div class="auth-footer">
            Already have an account?
            <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>

</x-guest-layout>