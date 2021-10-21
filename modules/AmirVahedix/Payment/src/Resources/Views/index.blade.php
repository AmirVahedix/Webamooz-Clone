@extends("Dashboard::master")

@section("title", "تراکنش ها")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تراکنش ها</a></li>
@endsection


@section("content")
    <div class="main-content font-size-13">
        <div class="row no-gutters  margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش ۳۰ روز گذشته سایت </p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>درامد خالص ۳۰ روز گذشته سایت</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش سایت</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> کل درآمد خالص سایت</p>
                <p>2,500,000 تومان</p>
            </div>
        </div>
        <div class="row no-gutters border-radius-3 font-size-13">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                محل نمودار درامد سی روز گذاشته
            </div>

        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            <h2 class="margin-bottom-15">همه تراکنش ها</h2>
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="شماره کارت / بخشی از شماره کارت">
                            <input type="text" class="text" placeholder="ایمیل">
                            <input type="text" class="text" placeholder="مبلغ به تومان">
                            <input type="text" class="text" placeholder="شماره">
                            <input type="text" class="text" placeholder="از تاریخ : 1399/10/11">
                            <input type="text" class="text margin-bottom-20" placeholder="تا تاریخ : 1399/10/12">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه پرداخت</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل / شماره موبایل</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد مدرس</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row">
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->buyer->name ?? '' }}</td>
                        <td>{{ $payment->buyer->email ?: $payment->buyer->mobile }}</td>
                        <td>{{ number_format($payment->amount) }} تومان</td>
                        <td>{{ number_format($payment->seller_share) }} تومان</td>
                        <td>{{ number_format($payment->site_share) }} تومان</td>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ jdate($payment->created_at) }}</td>
                        <td>{{ __($payment->status) }}</td>
                        <td>
                            <a href="" class="item-delete mlg-15"></a>
                            <a href="edit-transaction.html" class="item-edit"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
