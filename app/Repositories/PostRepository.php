<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPostById(int $id)
    {
        return Post::find($id);
    }
}
