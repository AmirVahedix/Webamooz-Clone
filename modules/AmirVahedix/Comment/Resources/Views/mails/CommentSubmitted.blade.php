@component('mail::message')
# دیدگاه جدیدی روی دوره شما ثبت شده است.

مدرس گرامی دیدگاه جدیدی برای {{ $comment->commentable->title }} در وب آموز ارسال شده است. لطفا در اسرع وقت پاسخ مناسبی ارسال بفرمایید.

@component('mail::button', [
    'url' => route('dashboard.comments.index')
])
    مشاهده کامنت
@endcomponent

با احترام، وب آموز
@endcomponent
