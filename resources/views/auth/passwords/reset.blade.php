@extends('auth.layouts.master')

@section('title', 'بازنشانی رمز عبور')

@section('content')
    <form action="{{ route('password.update') }}" method="POST" class="form">
        @csrf

        <a class="account-logo" href="index.html">
            <img src="{{ asset('img/weblogo.png') }}" alt="">
        </a>
        <div class="form-content form-account">
            <input type="hidden" name="token" value="{{ $token }}">

            <x-input name="email" type="email" placeholder="ایمیل" value="{{ $email }}" ltr readonly  />
            <x-input name="password" type="password" ltr placeholder="رمز عبور جدید" autocomplete="new-password" required />
            <x-input name="password_confirmation" ltr type="password" placeholder="تکرار رمز عبور جدید" autocomplete="new-password" required />

            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>

            <br>
            <button class="btn btn-recoverpass">بازنشانی</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
