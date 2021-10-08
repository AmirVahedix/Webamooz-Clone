@extends('auth.layouts.master')

@section('title', 'بازیابی رمز عبور')

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="form">
        @csrf
        <a class="account-logo" href="{{ route('index') }}">
            <img src="{{ asset('img/weblogo.png') }}" alt="">
        </a>


        <div class="form-content form-account">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <x-input name="email" type="email" placeholder="ایمیل" class="txt-l" autofocus autocomplete="email" required />
            <br>
            <button class="btn btn-recoverpass">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('login') }}">صفحه ورود</a>
        </div>
    </form>
@endsection
