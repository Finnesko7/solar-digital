<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    const LIMIT = 10;

    public function getMainByPostId(int $id)
    {
        return Comment::where('post_id', $id)->where('main', 1)->paginate(self::LIMIT);
    }
}
