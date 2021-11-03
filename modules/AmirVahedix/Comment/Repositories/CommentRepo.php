<?php

namespace AmirVahedix\Comment\Repositories;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Comment\Models\Comment;
use Illuminate\Http\Request;

class CommentRepo
{
    public function store (Request $request)
    {
        $request->request->add([ 'user_id' => auth()->id() ]);

        if (auth()->user()->can(Permission::PERMISSION_MANAGE_COMMENTS)) {
            $request->request->add([
                'status' => Comment::STATUS_APPROVED
            ]);
        }

        return Comment::query()->create($request->all());
    }
}
