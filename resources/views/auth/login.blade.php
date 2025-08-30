<meta name="viewport" content="width=device-width; initial-scale=1;" />


<title>تسجيل الدخول</title>
<img src="{{ asset('assets/img/uaered-pg.png') }}" alt="" class="uae-background">
<img src="{{ asset('assets/images/ask-logo.png') }}" alt="" class="ask-logo">
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

<div class="login-container">
    <h2 class="login-title">تسجيل الدخول</h2>

    @if (session('status'))
    <div class="status-message">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group-flex">
            <div class="form-group form-group-half-width">
                <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="أدخل كلمة المرور" />
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group form-group-half-width">
                <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="أدخل بريدك الإلكتروني" />
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="login-button">
                {{ __('تسجيل الدخول') }}
            </button>
        </div>
        <span class="developed">
            تم التطوير بواسطة شركة إيفورك
        </span>
    </form>
    <img class="footer-logo" src="{{ asset('assets/img/footer-logo.webp') }}" alt="">
</div>
