<?php

namespace AmirVahedix\Comment\Repositories;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Comment\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CommentRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Comment::query();
    }

    public function paginate($per_page = 25): LengthAwarePaginator
    {
        return $this->query
            ->whereNull('parent_id')
            ->latest()
            ->paginate($per_page);
    }

    public function searchBody($body): CommentRepo
    {
        if ($body) {
            $this->query->where('body', 'LIKE', "%$body%");
        }
        return $this;
    }

    public function searchEmail($email): CommentRepo
    {
        if ($email) {
            $this->query
                ->join('users', 'comments.user_id', 'users.id')
                ->select('users.email', 'comments.*')
                ->where('users.email', "LIKE", "%$email%");
        }

        return $this;
    }

    public function searchName($name): CommentRepo
    {
        if ($name) {
            $this->query->where('name', 'LIKE', "%$name%");
        }
        return $this;
    }

    public function searchStatus($status)
    {
        if ($status) {
            $this->query->where('status', $status);
        }
        return $this;
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
