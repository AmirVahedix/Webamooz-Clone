<?php

namespace AmirVahedix\Comment\Repositories;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Comment\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CommentRepo
{
    public function paginate($per_page = 25): LengthAwarePaginator
    {
        return Comment::query()
            ->whereNull('parent_id')
            ->latest()
            ->paginate($per_page);
    }

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

    public function findApproved ($comment_id)
    {
        return Comment::query()->where("id", $comment_id)
            ->where('status', Comment::STATUS_APPROVED)
            ->first();
    }
}
