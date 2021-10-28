@extends('Dashboard::master')

@section('title', 'مشاهده تیکت')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('dashboard.tickets.index') }}">تیکت ها</a></li>
    <li><a href="#">مشاهده تیکت</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="{{ route('dashboard.tickets.index') }}"></a>
                    <div>
                        <p class="comment-name"><a href="">{{ $ticket->title }}</a></p>
                    </div>
                </div>
            </div>
            @foreach($ticket->replies as $reply)
                <div class="transition-comment {{ $reply->user_id == $ticket->user_id ? '' : 'is-answer' }}">
                    <div class="transition-comment-header">
                       <span>
                           <img src="{{ $reply->user->user_avatar ?? asset('panel/img/pro.jpg') }}" alt="" class="logo-pic">
                       </span>
                        <span class="nav-comment-status">
                            <span class="username">{{ $reply->user->name }}</span>
                            <span class="comment-date">{{ jdate($reply->created_at)->ago() }}</span>
                        </span>
                        <div>
                        </div>
                    </div>
                    <div class="transition-comment-body padding-30">
                        {{ $reply->body }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="answer-comment">
            <p class="p-answer-comment">ارسال پاسخ</p>
            <form action="{{ route('dashboard.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="">
                @csrf
                <x-textarea name="body" label="متن تیکت" class="text" />
                <x-file name="attachment" label="انتخاب فایل پیوست" />
                <button class="btn btn-webamooz_net">ایجاد مقاله</button>
            </form>
        </div>
    </div>

@endsection
