@extends('auth.layouts.master')

@section('title', 'ثبت‌نام در وب‌آموز')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="form">
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <x-input name="name" placeholder="نام و نام خانوادگی" autocomplete="name" autofocus required />
            <x-input name="email" placeholder="ایمیل" autocomplete="email" required />
            <x-input name="password" placeholder="رمز عبور" autocomplete="new-password" required />
            <x-input name="password_confirmation" placeholder="تکرار رمز عبور" autocomplete="new-password" required />

            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
