@extends('User::auth.layouts.master')

@section('title', 'تایید حساب کاربری')

@section('content')
    <form action="{{ route('verification.verify', auth()->id()) }}" method="POST" class="form">
        @csrf

        <a class="account-logo" href="{{ route('index') }}">
            <img src="{{ asset('img/weblogo.png') }}" alt="">
        </a>
        <div class="card-header">
            <p class="activation-code-title">
                کد تایید به ایمیل شما ارسال شد.
                <br />
                کد فرستاده شده را در کادر زیر وارد کنید.
            </p>
        </div>
        <div class="form-content form-content1">
            <x-input name="verify_code" class="activation-code-input" placeholder="فعال سازی" />
            <br>
            <button class="btn i-t">تایید</button>
        </div>
        <div class="form-footer">
            <a href="{{ route('register') }}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/activation-code.js') }}"></script>
@endsection
