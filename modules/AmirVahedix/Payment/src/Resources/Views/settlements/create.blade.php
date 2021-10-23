@extends("Dashboard::master")

@section("title", "درخواست تسویه")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تسویه حساب‌ها</a></li>
    <li><a href="">درخواست تسویه</a></li>
@endsection

@section("content")
    <div class="main-content">
        <form action="" class="padding-30 bg-white font-size-14">
            <x-input name="cart" placeholder="شماره کارت" class="text" />
            <x-input name="name" placeholder="نام صاحب حساب" class="text" />
            <x-input name="owner" placeholder="مبلغ به تومان" class="text" />

            <div class="row no-gutters border-2 margin-bottom-15 mt-2 text-center ">
                <div class="w-50 padding-20 w-50">موجودی قابل برداشت :‌</div>
                <div class="bg-fafafa padding-20 w-50"> {{ number_format(auth()->user()->balance) }} تومان</div>
            </div>
            <div class="row no-gutters border-2 text-center margin-bottom-15">
                <div class="w-50 padding-20">حداکثر زمان واریز :‌</div>
                <div class="w-50 bg-fafafa padding-20">۳ روز</div>
            </div>
            <button class="btn btn-webamooz_net">درخواست تسویه</button>
        </form>
    </div>
@endsection
