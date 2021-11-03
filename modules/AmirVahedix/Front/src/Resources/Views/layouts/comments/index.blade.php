<div class="container">
    <div class="comments">
        @include("Front::layouts.comments.create", ["commentable" => $course])

        <div class="comments-list">
            @include("Front::layouts.comments.reply", ["commentable" => $course])

            @foreach ($commentable->approvedComments as $comment)
                <ul class="comment-list-ul">
                    <div class="div-btn-answer">
                        <button class="btn-answer" onclick="setParentId({{ $comment->id }})">پاسخ به دیدگاه</button>
                    </div>
                    <li class="is-comment">
                        <div class="comment-header">
                            <div class="comment-header-avatar">
                                <img src="{{ $comment->user->user_avatar ?? asset('panel/img/pro.jpg') }}" alt="{{ $comment->user->name }}">
                            </div>
                            <div class="comment-header-detail">
                                <div class="comment-header-name">{{ $comment->user->name }}</div>
                                <div class="comment-header-date">{{ jdate($comment->created_at)->ago() }}</div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>{{ $comment->body }}</p>
                        </div>
                    </li>
                    @foreach ($comment->children as $child)
                        <li class="is-answer">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="{{ $child->user->user_avatar ?? asset('panel/img/pro.jpg') }}" alt="{{ $child->user->name }}">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">{{ $child->user->name }}</div>
                                    <div class="comment-header-date">{{ jdate($child->created_at)->ago() }}</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>{{ $child->body }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
       </div>
    </div>
</div>
