@extends('auth.layouts.master')

@section('title', 'تایید حساب کاربری')

@section('content')
    <form class="form" method="POST" action="{{ route('verification.resend') }}">
        @csrf

        <a class="account-logo" href="index.html">
            <img src="{{ asset('img/weblogo.png') }}" alt="">
        </a>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                لینک فعالسازی جدید به ایمیل شما ارسال شد.
            </div>
        @endif

        <div class="card-header">
            <p class="activation-code-title">
                لینک فعالسازی به ایمیل شما ارسال شده است. لطفا ایمیل خود را چک کنید.
            </p>
        </div>
        <div class="form-content form-content1">
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                ارسال مجدد ایمیل فعالسازی
            </button>
            <div class="form-footer">
                <a href="{{ route('register') }}">صفحه ثبت نام</a>
            </div>
        </div>
    </form>
@endsection
