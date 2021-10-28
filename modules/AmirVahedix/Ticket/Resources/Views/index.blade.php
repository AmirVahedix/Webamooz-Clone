@extends('Dashboard::master')

@section('title', 'تیکت ها')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">تیکت ها</a></li>
@endsection

@section('content')
    <div class="main-content tickets">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('dashboard.tickets.index') }}">همه تیکت ها</a>
                <a class="tab__item " href="tickets.html">جدید ها (خوانده نشده)</a>
                <a class="tab__item " href="tickets.html">پاسخ داده شده ها</a>
                <a class="tab__item " href="{{ route('dashboard.tickets.create') }}">ارسال تیکت جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در تیکت ها">
                        <div class="t-header-search-content ">
                            <input type="text"  class="text"  placeholder="ایمیل">
                            <input type="text"  class="text "  placeholder="نام و نام خانوادگی">
                            <input type="text"  class="text margin-bottom-20"  placeholder="تاریخ">
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
                    <th>عنوان</th>
                    <th>نام کاربر</th>
                    <th>ایمیل / تلفن کاربر</th>
                    <th>آخرین بروزرسانی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr role="row" >
                        <td>
                            <a href="{{ route('dashboard.tickets.show', $ticket->id) }}">
                                {{ $ticket->title }}
                            </a>
                        </td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->user->email ?: $ticket->user->phone }}</td>
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
                            <a href="" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{ route('dashboard.tickets.show', $ticket->id) }}" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="edit-comment.html" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
