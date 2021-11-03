@extends('Dashboard::master')

@section('title', 'مشاهده کامنت')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="{{ route('dashboard.comments.index') }}">کامنت ها</a></li>
    <li><a href="#">مشاهده کامنت</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="{{ route('dashboard.comments.index') }}"></a>
                    <div>
                        <p class="comment-name"><a href="">{{ $comment->commentable->title }}</a></p>
                    </div>
                </div>
            </div>
            <div class="transition-comment">
                <div class="transition-comment-header">
                   <span>
                        <img src="{{ $comment->user->user_avatar ?? asset('panel/img/pro.jpg') }}" class="logo-pic"
                             alt="">
                   </span>
                    <span class="nav-comment-status">
                        <p class="username">{{ $comment->user->name }}</p>
                        <span class="comment-date">{{ jdate($comment->created_at)->ago() }}</span>
                    </span>
                </div>
                <div class="transition-comment-body">
                    <div class="padding-30">
                        {{ $comment->body }}
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            @foreach($comment->children as $child)
                <div class="transition-comment {{ $child->user_id != $comment->user_id ? 'is-answer' : '' }}">
                    <div class="transition-comment-header">
                       <span>
                             <img src="{{ $child->user->user_avatar ?? asset('panel/img/pro.jpg') }}" class="logo-pic" alt="">
                       </span>
                        <span class="nav-comment-status">
                            <p class="username">{{ $child->user->name }}</p>
                            <p class="comment-date">{{ jdate($child->created_at)->ago() }}</p></span>
                        <div>
                        </div>
                    </div>
                    <div class="transition-comment-body">
                        <div class="padding-30">
                            {{ $child->body }}
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="answer-comment">
            <p class="p-answer-comment">ارسال پاسخ</p>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" id="parent_id" name="parent_id" value="{{ $comment->id }}">
                <input type="hidden" name="commentable_type" value="{{ get_class($comment->commentable) }}">
                <input type="hidden" name="commentable_id" value="{{ $comment->commentable->id }}">

                <x-textarea name="body" class="txt hi-220px" label="پاسخ خود را بنویسید..." />
                <button class="btn btn-webamooz_net i-t">ثبت پاسخ</button>
            </form>
        </div>
    </div>
@endsection
