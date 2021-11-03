<?php

namespace AmirVahedix\Comment\Http\Controllers;

use AmirVahedix\Comment\Http\Requests\StoreCommentRequest;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function store (StoreCommentRequest $request)
    {
        $commentable =  $request->commentable_type::findOrFail($request->commentable_id);
        dd($commentable);
    }
}
