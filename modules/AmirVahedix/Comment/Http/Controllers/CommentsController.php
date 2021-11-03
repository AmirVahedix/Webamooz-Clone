<?php

namespace AmirVahedix\Comment\Http\Controllers;

use AmirVahedix\Comment\Http\Requests\StoreCommentRequest;
use AmirVahedix\Comment\Repositories\CommentRepo;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    private $commentRepo;

    public function __construct (CommentRepo $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function store (StoreCommentRequest $request)
    {
        $this->commentRepo->store($request);

        toast('نظر باموفقیت ثبت شد و پس از تایید نمایش داده میشود.', 'success');
        // $commentable =  $request->commentable_type::findOrFail($request->commentable_id);
        return back();
    }
}
