<?php

namespace AmirVahedix\Comment\Http\Controllers;

use AmirVahedix\Comment\Events\CommentSubmittedEvent;
use AmirVahedix\Comment\Http\Requests\StoreCommentRequest;
use AmirVahedix\Comment\Models\Comment;
use AmirVahedix\Comment\Repositories\CommentRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    private $commentRepo;

    public function __construct (CommentRepo $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('manage', Comment::class);

        $comments = $this->commentRepo
            ->searchBody($request->get('body'))
            ->searchEmail($request->get('email'))
            ->searchName($request->get('name'))
            ->searchStatus($request->get('status'))
            ->paginate();

        return view('Comment::index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        $this->authorize('manage', Comment::class);

        return view('Comment::show', compact('comment'));
    }

    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $comment = $this->commentRepo->store($request);
        event(new CommentSubmittedEvent($comment));

        toast('نظر باموفقیت ثبت شد و پس از تایید نمایش داده میشود.', 'success');
        return back();
    }

    public function delete(Comment $comment): RedirectResponse
    {
        $this->authorize('manage', Comment::class);

        $comment->children()->delete();
        $comment->delete();

        toast('نظر باموفقیت حذف شد.', 'success');
        return back();
    }

    public function approve(Comment $comment): RedirectResponse
    {
        $this->authorize('manage', Comment::class);

        $comment->update([ 'status' => Comment::STATUS_APPROVED ]);
        toast('نظر تایید شد.', 'success');
        return back();
    }

    public function reject(Comment $comment): RedirectResponse
    {
        $this->authorize('manage', Comment::class);

        $comment->update([ 'status' => Comment::STATUS_REJECTED ]);
        toast('نظر رد شد.', 'success');
        return back();
    }
}
