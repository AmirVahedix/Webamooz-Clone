@extends('auth.layouts.master')

@section('title', 'ورود به وب‌آموز')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form">
        @csrf
        <a class="account-logo" href="{{ route('index') }}">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <x-input name="email" class="txt-l" placeholder="ایمیل یا شماره تلفن" required />
            <x-input name="password" type="password" class="txt-l" placeholder="رمز عبور" reqiured />
            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="recoverpassword.html">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('register') }}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
