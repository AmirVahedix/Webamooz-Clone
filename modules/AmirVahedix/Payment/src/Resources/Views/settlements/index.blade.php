@extends("Dashboard::master")

@section("title", "درخواست تسویه")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تسویه حساب‌ها</a></li>
    <li><a href="">درخواست تسویه</a></li>
@endsection

@section("content")
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item {{ request()->get('status') ? '' : 'is-active' }}" href="?"> همه تسویه ها</a>
                <a class="tab__item {{ request()->get('status') ? 'is-active' : '' }}" href="?status={{ \AmirVahedix\Payment\Models\Settlement::STATUS_SETTLED }}">تسویه های واریز شده</a>
                <a class="tab__item " href="{{ route('dashboard.settlements.create') }}">درخواست تسویه جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13"
                               placeholder="جستجوی در تسویه حساب ها">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="شماره کارت">
                            <input type="text" class="text" placeholder="شماره">
                            <input type="text" class="text" placeholder="تاریخ">
                            <input type="text" class="text" placeholder="ایمیل">
                            <input type="text" class="text margin-bottom-20" placeholder="نام و نام خانوادگی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه تسویه</th>
                    <th>مبدا</th>
                    <th>مقصد</th>
                    <th>شماره کارت</th>
                    <th>تاریخ درخواست واریز</th>
                    <th>تاریخ واریز شده</th>
                    <th>مبلغ (تومان )</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($settlements as $settlement)
                    <tr role="row">
                        <td>{{ $settlement->transaction_id }}</td>
                        <td>{{ $settlement->from ? $settlement->from['name'] : '-' }}</td>
                        <td>{{ $settlement->to['name'] }}</td>
                        <td>{{ $settlement->to['cart'] }}</td>
                        <td>{{ jdate($settlement->created_at)->ago() }}</td>
                        <td>{{ $settlement->settled_at ? jdate($settlement->settled_at) : 'در انتظار'  }}</td>
                        <td>{{ number_format($settlement->amount) }} تومان</td>
                        <td>
                            @if($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_SETTLED)
                                <span class="text-success">تسویه شده</span>
                            @else
                                <span class="text-error">{{ __($settlement->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="item-delete mlg-15" title="حذف"></a>
                            <a href="show-comment.html" class="item-reject mlg-15" title="رد"></a>
                            <a href="show-comment.html" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="edit-comment.html" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
