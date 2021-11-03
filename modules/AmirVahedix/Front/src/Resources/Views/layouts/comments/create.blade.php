<div class="comment-main">
    <div class="ct-header">
        <h3>نظرات ( 180 )</h3>
        <p>نظر خود را در مورد این دوره مطرح کنید</p>
    </div>
    <form action="{{ route('comments.store', $course->id) }}" method="post">
        <div class="ct-row">
            <div class="ct-textarea">
                <x-textarea name="body" class="txt ct-textarea-field" label="کامنت خود را بنویسید..." />
            </div>
        </div>
        <div class="ct-row">
            <div class="send-comment">
                <button type="submit" class="btn i-t">ثبت نظر</button>
            </div>
        </div>
    </form>
</div>
