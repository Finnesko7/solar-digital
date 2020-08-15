<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostRepository
{
    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    public function getPostById(int $id): ?Post
    {
        return Post::find($id);
    }

    public function update(int $id, array $data): bool
    {
        return Post::where('id', $id)->update($data);
    }

    public function create(array $data) : Post
    {
        return Post::create($data);
    }

    public function delete(int $id) : bool
    {
        return Post::where('id', $id)->delete();
    }
}
