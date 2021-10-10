@extends('User::auth.layouts.master')

@section('title', 'بازیابی رمز عبور')

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="form">
        @csrf
        <a class="account-logo" href="{{ route('index') }}">
            <img src="{{ asset('img/weblogo.png') }}" alt="">
        </a>

        <div class="form-content form-account">
            <x-input name="email" type="email" placeholder="ایمیل" class="txt-l" autofocus autocomplete="email" required />
            <br>
            <button class="btn btn-recoverpass">بازیابی</button>
        </div>

        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
