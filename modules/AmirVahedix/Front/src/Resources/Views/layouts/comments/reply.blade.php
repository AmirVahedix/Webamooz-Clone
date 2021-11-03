<div id="Modal2" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <p>ارسال پاسخ</p>
            <div class="close">&times;</div>
        </div>
        <div class="modal-body">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" id="parent_id" name="parent_id" value="">
                <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
                <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">

                <x-textarea name="body" class="txt hi-220px" label="پاسخ خود را بنویسید..." />
                <button class="btn i-t">ثبت پاسخ</button>
            </form>
        </div>
    </div>
</div>
