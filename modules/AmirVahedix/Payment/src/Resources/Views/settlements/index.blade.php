@extends("Dashboard::master")

@section("title", "درخواست تسویه")

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="">تسویه حساب‌ها</a></li>
@endsection

@section("content")
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item {{ request()->get('status') ? '' : 'is-active' }}" href="?"> همه تسویه ها</a>
                <a class="tab__item {{ request()->get('status') ? 'is-active' : '' }}"
                   href="?status={{ \AmirVahedix\Payment\Models\Settlement::STATUS_SETTLED }}">تسویه های واریز شده</a>
                @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_TEACH)
                    <a class="tab__item " href="{{ route('dashboard.settlements.create') }}">درخواست تسویه جدید</a>
                @endcan

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
                    <th>نام کاربر</th>
                    <th>شماره تلفن / ایمیل کاربر</th>
                    <th>شماره کارت</th>
                    <th>تاریخ درخواست واریز</th>
                    <th>تاریخ واریز شده</th>
                    <th>مبلغ (تومان )</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($settlements as $settlement)
                    <tr role="row" x-data="{accept_modal: false, reject_modal: false, cancel_modal: false}">
                        <td>{{ $settlement->transaction_id }}</td>
                        <td>{{ $settlement->from ? $settlement->from['name'] : 'وب آموز' }}</td>
                        <td>{{ $settlement->to['name'] }}</td>
                        <td>
                            <a href="{{ route('users.info', $settlement->user) }}">
                                {{ $settlement->user->name }}
                            </a>
                        </td>
                        <td>{{ $settlement->user->phone ?: $settlement->user->email }}</td>
                        <td>{{ $settlement->to['cart'] }}</td>
                        <td>{{ jdate($settlement->created_at)->ago() }}</td>
                        <td>{{ $settlement->settled_at ? jdate($settlement->settled_at) : 'در انتظار'  }}</td>
                        <td>{{ number_format($settlement->amount) }} تومان</td>
                        <td>
                            @if($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_SETTLED)
                                <span class="text-success">تسویه شده</span>
                            @elseif ($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_WAITING)
                                <span class="text-warning">{{ __($settlement->status) }}</span>
                            @else
                                <span class="text-error">{{ __($settlement->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_MANAGE_PAYMENTS)
                                @if($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_WAITING)
                                    <a href="#" x-on:click="reject_modal=true"
                                       class="item-reject mlg-15" title="رد"></a>
                                    <a href="#" x-on:click="accept_modal=true"
                                       class="item-confirm mlg-15" title="تایید"></a>
                                @elseif($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_REJECTED)
                                    <a href="#" x-on:click="accept_modal=true"
                                       class="item-confirm mlg-15" title="تایید"></a>
                                @endif
                            @else
                                @if($settlement->status == \AmirVahedix\Payment\Models\Settlement::STATUS_WAITING)
                                    <a href="#" x-on:click="cancel_modal=true"
                                       class="item-reject mlg-15" title="لغو"></a>
                                @endif
                            @endcan
                        </td>
                        {{--Accept Modal--}}
                        <td class="padding-0">
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="accept_modal"
                                 x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="accept_modal=false">
                                    <h3>آیا از تایید این درخواست اطمینان دارید؟</h3>
                                    <p>با کلیک بر روی تایید، موجودی حساب کاربر کسر شده و درخواست وی تایید میشود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="accept_modal=false">انصراف
                                        </button>
                                        <form action="{{ route('dashboard.settlements.accept', $settlement) }}"
                                              method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-webamooz_net">تایید درخواست</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{--Reject Modal--}}
                        <td class="padding-0">
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="reject_modal"
                                 x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="reject_modal=false">
                                    <h3>آیا از رد این درخواست اطمینان دارید؟</h3>
                                    <p>با کلیک بر روی رد، موجودی حساب کاربر تغییر نکرده شده و درخواست وی رد میشود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="reject_modal=false">انصراف
                                        </button>
                                        <form action="{{ route('dashboard.settlements.reject', $settlement) }}"
                                              method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-webamooz_net">رد کردن درخواست</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{--Cancel Modal--}}
                        <td class="padding-0">
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="cancel_modal"
                                 x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="cancel_modal=false">
                                    <h3>آیا از لغو این درخواست اطمینان دارید؟</h3>
                                    <p>با کلیک بر روی لغو، پرداختی برای شما انجام نشده و درخواست شما لغو میشود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="cancel_modal=false">انصراف
                                        </button>
                                        <form action="{{ route('dashboard.settlements.cancel', $settlement) }}"
                                              method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-webamooz_net">لغو درخواست</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
