@extends('Dashboard::master')

@section('title', 'تیکت ها')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">تیکت ها</a></li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/persianDatePicker.css') }}">
@endsection

@section('content')
    <div class="main-content tickets">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item {{ request()->get('status') == '' ? 'is-active' : '' }}"
                   href="{{ route('dashboard.tickets.index') }}">همه تیکت ها</a>

                @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_MANAGE_TICKETS)
                    <a class="tab__item {{ request()->get('status') == 'waiting' ? 'is-active' : '' }}"
                       href="?status=waiting">تیکت‌های جدید (خوانده نشده)</a>

                    <a class="tab__item {{ request()->get('status') == 'answered' ? 'is-active' : '' }}"
                       href="?status=answered">تیکت‌های پاسخ داده شده</a>
                @endcan

                <a class="tab__item" href="{{ route('dashboard.tickets.create') }}">ارسال تیکت جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            @include("Ticket::layouts.search-box")
        </div>

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>عنوان</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>شماره تلفن</th>
                    <th>تاریخ ایجاد</th>
                    <th>آخرین بروزرسانی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr role="row" x-data="{delete_modal: false}">
                        <td>
                            <a href="{{ route('dashboard.tickets.show', $ticket->id) }}">
                                {{ $ticket->title }}
                            </a>
                        </td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->user->email }}</td>
                        <td>{{ $ticket->user->mobile }}</td>
                        <td>{{ jdate($ticket->created_at)->format('Y/m/d') }}</td>
                        <td>{{ jdate($ticket->updated_at)->format('Y/m/d') }}</td>
                        <td>
                            @if($ticket->status == \AmirVahedix\Ticket\Models\Ticket::STATUS_WAITING)
                                <span class="text-info">{{ __($ticket->status) }}</span>
                            @elseif($ticket->status == \AmirVahedix\Ticket\Models\Ticket::STATUS_ANSWERED)
                                <span class="text-success">{{ __($ticket->status) }}</span>
                            @elseif($ticket->status == \AmirVahedix\Ticket\Models\Ticket::STATUS_CLOSED)
                                <span class="text-error">{{ __($ticket->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @can(\AmirVahedix\Authorization\Models\Permission::PERMISSION_MANAGE_TICKETS)
                                <a href="#" x-on:click="delete_modal=true" class="item-delete mlg-15" title="حذف"></a>
                            @endcan
                            @if($ticket->status !== \AmirVahedix\Ticket\Models\Ticket::STATUS_CLOSED)
                                <a href="{{ route('dashboard.tickets.close', $ticket->id) }}" class="item-reject mlg-15"
                                   title="بستن تیکت"></a>
                            @endif
                            <a href="{{ route('dashboard.tickets.show', $ticket->id) }}" class="item-eye mlg-15"
                               title="مشاهده تیکت"></a>
                        </td>
                        <td class="padding-0">
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')"
                                 x-show="delete_modal"
                                 x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="delete_modal=false">
                                    <h3>آیا از حذف این تیکت اطمینان دارید؟</h3>
                                    <p>با حذف این تیکت دیگر نه شما و نه کاربر قادر به مشاهده آن نخواهید بود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="delete_modal=false">
                                            انصراف
                                        </button>
                                        <form action="{{ route('dashboard.tickets.destroy', $ticket) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-webamooz_net">
                                                حذف تیکت
                                            </button>
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


@section('scripts')
    <script src="{{ asset('js/persianDatePicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#date, #date_span").persianDatepicker({
                formatDate: "YYYY/0M/0D"
            });
        });
    </script>
@endsection
