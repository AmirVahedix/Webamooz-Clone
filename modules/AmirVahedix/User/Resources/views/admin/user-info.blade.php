@extends('Dashboard::master')

@section('title', 'جزئیات کاربر')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('admin.users.index') }}">کاربران</a></li>
    <li><a href="#">جزیات کاربر</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div>
            <p class="box__title">جزئیات کاربر</p>
            <div class="bg-white padding-30">
                <ul>
                    <li>
                        <span>نام: </span>
                        <span>{{ $user->name }}</span>
                    </li>
                    <li>
                        <span>شماره تلفن: </span>
                        <span>{{ $user->mobile }}</span>
                    </li>
                    <li>
                        <span>ایمیل: </span>
                        <span>{{ $user->email }}</span>
                    </li>
                    <li>
                        <span>نام کاربری: </span>
                        <span>{{ $user->username }}</span>
                    </li>
                    <li>
                        <span>عنوان شغلی: </span>
                        <span>{{ $user->headline }}</span>
                    </li>
                    <li>
                        <span>بیو: </span>
                        <span>{{ $user->bio }}</span>
                    </li>
                    <li>
                        <span>موجودی حساب: </span>
                        <span>{{ number_format($user->balance) }} تومان</span>
                    </li>
                    <li>
                        <span>تاریخ تایید حساب: </span>
                        <span>{{ $user->email_verified_at ? jdate($user->email_verified_at)->ago() : 'تایید نشده' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-6" style="padding-top: 16px; padding-right: 16px">
                <p class="box__title">دوره‌های درحال تدریس</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>نام دوره</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->courses as $course)
                            <tr role="row" class="">
                                <td><a href="">{{ $course->title }}</a></td>
                                <td>{{ __($course->status) }}</td>
                                <td>{{ jdate($course->created_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6" style="padding-top: 16px; padding-right: 16px">
                <p class="box__title">درخواست‌های تسویه</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شماره کارت</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                            <th>تاریخ واریز</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->settlements as $settlement)
                            <tr role="row" class="">
                                <td>{{ $settlement->to['cart'] }}</td>
                                <td>{{ __($settlement->status) }}</td>
                                <td>{{ jdate($settlement->created_at)->format('Y/m/d') }}</td>
                                <td>{{ $settlement->settled_at ? jdate($settlement->settled_at)->format('Y/m/d') : 'واریز نشده' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6" style="padding-top: 16px; padding-right: 16px">
                <p class="box__title">پرداخت ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>عنوان پرداختی</th>
                            <th>مبلغ</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->payments as $payment)
                            <tr role="row" class="">
                                <td><a href="">{{ $payment->paymentable->title }}</a></td>
                                <td>{{ number_format($payment->amount) }} تومان</td>
                                <td>{{ __($payment->status) }}</td>
                                <td>{{ jdate($payment->created_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6" style="padding-top: 16px; padding-right: 16px">
                <p class="box__title">دوره‌های خریداری شده</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>عنوان دوره</th>
                            <th>تاریخ ثبت نام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->purchases as $purchase)
                            <tr role="row" class="">
                                <td>{{ $purchase->title }}</td>
                                <td>{{ jdate($purchase->creted_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
