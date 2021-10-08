@extends('auth.layouts.master')

@section('title', 'ثبت‌نام در وب‌آموز')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="form">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">

            <x-input name="name" placeholder="نام و نام خانوادگی" autocomplete="name" autofocus required />
            <x-input name="email" type="email" class="txt-l" placeholder="ایمیل" autocomplete="email" required />
            <x-input name="mobile" type="tel" class="txt-l" placeholder="شماره تلفن" autocomplete="tel" required />
            <x-input name="password" type="password" class="txt-l" placeholder="رمز عبور" autocomplete="new-password" required />
            <x-input name="password_confirmation" class="txt-l" type="password" placeholder="تکرار رمز عبور" autocomplete="new-password" required />

            <span class="rules">رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
