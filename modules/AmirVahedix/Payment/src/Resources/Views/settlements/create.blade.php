@extends("Dashboard::master")

@section("title", "درخواست تسویه")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('dashboard.settlements.index') }}">تسویه حساب‌ها</a></li>
    <li><a href="">درخواست تسویه</a></li>
@endsection

@section("content")
    <div class="main-content">
        @if(auth()->user()->checkHasWaitingSettlement())
            <div class="bg-white padding-30">
                درخواست تسویه شما در حال بررسی میباشد. پیش از تایید یا رد شدن درخواست قبلی نمیتوانید درخواست جدیدی ثبت کنید.
            </div>
        @endif
        <form action="{{ route('dashboard.settlements.store') }}" method="POST" class="padding-30 bg-white font-size-14 mt-2">
            @csrf

            <x-input name="cart" placeholder="شماره کارت" class="text" />
            <x-input name="name" placeholder="نام صاحب حساب" class="text" />
            <x-input name="amount" placeholder="مبلغ به تومان" class="text" value="{{ auth()->user()->balance }}" />

            <div class="row no-gutters border-2 margin-bottom-15 mt-2 text-center ">
                <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{ number_format(auth()->user()->balance) }} تومان</div>
            </div>
            <div class="row no-gutters border-2 text-center margin-bottom-15">
                <div class="w-50 padding-20">حداکثر زمان واریز :‌</div>
                <div class="w-50 bg-fafafa padding-20">۳ روز</div>
            </div>
            <button class="btn btn-webamooz_net" {{ auth()->user()->checkHasWaitingSettlement() ? 'disabled' : '' }}>درخواست تسویه</button>
        </form>
    </div>
@endsection
