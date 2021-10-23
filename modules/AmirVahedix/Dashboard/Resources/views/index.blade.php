@extends('Dashboard::master')

@section('title', 'داشبورد وب آموز')

@section('breadcrumbs')
    <li><a href="#">پیشخوان</a></li>
@endsection

@section('content')
    <div class="main-content">
        @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_TEACH)
            <div class="row no-gutters font-size-13 margin-bottom-10">
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> موجودی حساب فعلی </p>
                    <p>{{ number_format(auth()->user()->balance) }} تومان</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> کل فروش دوره ها</p>
                    <p>{{ number_format($teacherTotalSellAmount) }} تومان</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> کارمزد کسر شده </p>
                    <p>{{ number_format($teacherTotalSellAmount - $teacherTotalSellBenefit) }} تومان</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                    <p> درآمد خالص </p>
                    <p>{{ number_format($teacherTotalSellBenefit) }} تومان</p>
                </div>
            </div>
            <div class="row no-gutters font-size-13 margin-bottom-10">
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> درآمد امروز </p>
                    <p>{{ number_format($teacherTodayBenefit) }} تومان</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> درآمد 30 روز گذاشته</p>
                    <p>{{ number_format($teacherLast30DayBenefit) }} تومان</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> تسویه حساب در حال انجام </p>
                    <p>0 تومان </p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
                    <p>تراکنش های موفق امروز ({{ $teacherTodaySuccessPayments }}) تراکنش </p>
                    <p>{{ number_format($teacherTodayTotalAmount) }} تومان</p>
                </div>
            </div>
        @endcan

        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                <div id="payment_chart"></div>
            </div>
            <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

                <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
                <p class="amount-show color-444">600,000<span> تومان </span></p>
                <p class="title icon-sync">در حال تسویه</p>
                <p class="amount-show color-444">0<span> تومان </span></p>
                <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13">
            <div class="title__row">
                <p>تراکنش‌های اخیر دوره‌های شما</p>
                <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>عنوان پرداختی</th>
                        <th>خریدار</th>
                        <th>مبلغ پرداختی</th>
                        <th>دریافتی شما</th>
                        <th>تاریخ و ساعت</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->paymentable->title }}</td>
                            <td>{{ $payment->buyer->name }}</td>
                            <td>{{ number_format($payment->amount) }} تومان</td>
                            <td>{{ number_format($payment->seller_share) }} تومان</td>
                            <td>{{ jdate($payment->created_at)->format('Y/m/d') }}</td>
                            <td>
                                @if($payment->status === \AmirVahedix\Payment\Models\Payment::STATUS_SUCCESS)
                                    <span class="text-success">{{ __($payment->status) }}</span>
                                @else
                                    <span class="text-error">{{ __($payment->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('Payment::chart')
@endsection
