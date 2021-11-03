@extends('Dashboard::master')

@section('title', 'نظرات')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">نظرات</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('dashboard.comments.index') }}"> همه نظرات</a>
                <a class="tab__item " href="comments.html">نظرات تاییده نشده</a>
                <a class="tab__item " href="comments.html">نظرات تاییده شده</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در نظرات">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="قسمتی از متن">
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
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr role="row" x-data="{delete_modal: false}">
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->commentable->title }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ jdate($comment->created_at)->format('Y/m/d') }}</td>
                        <td>{{ $comment->children->count() }} ({{ $comment->children->where('status', \AmirVahedix\Comment\Models\Comment::STATUS_APPROVED)->count() }})</td>
                        <td class="{{ $comment->status_class }}">{{ __($comment->status) }}</td>
                        <td>
                            <a href="#" x-on:click="delete_modal=true" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{ route('dashboard.comments.show', $comment->id) }}" class="item-eye mlg-15" title="مشاهده"></a>
                            @unless($comment->status == \AmirVahedix\Comment\Models\Comment::STATUS_REJECTED)
                                <a href="{{ route('dashboard.comments.reject', $comment->id) }}" class="item-reject mlg-15" title="رد"></a>
                            @endunless
                            @unless($comment->status == \AmirVahedix\Comment\Models\Comment::STATUS_APPROVED)
                                <a href="{{ route('dashboard.comments.approve', $comment->id) }}" class="item-confirm mlg-15" title="تایید"></a>
                            @endunless
                        </td>
                        <td class="padding-0">
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')"
                                 x-show="delete_modal"
                                 x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="delete_modal=false">
                                    <h3>آیا از حذف این نظر اطمینان دارید؟</h3>
                                    <p>با حذف این کامنت، پاسخ‌های این کامنت نیز به طور کامل حذف خواهد شد.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="delete_modal=false">
                                            انصراف
                                        </button>
                                        <form action="{{ route('dashboard.comments.destroy', $comment) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-webamooz_net">
                                                حذف نظر
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
