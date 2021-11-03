<?php

namespace AmirVahedix\Comment\Http\Controllers;

use AmirVahedix\Comment\Http\Requests\StoreCommentRequest;
use AmirVahedix\Comment\Models\Comment;
use AmirVahedix\Comment\Repositories\CommentRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    private $commentRepo;

    public function __construct (CommentRepo $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function index()
    {
        $comments = $this->commentRepo->paginate();
        return view('Comment::index', compact('comments'));
    }

    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $this->commentRepo->store($request);

        toast('نظر باموفقیت ثبت شد و پس از تایید نمایش داده میشود.', 'success');
        return back();
    }

    public function delete(Comment $comment)
    {
        $comment->children()->delete();
        $comment->delete();

        toast('نظر باموفقیت حذف شد.', 'success');
        return back();
    }
}
