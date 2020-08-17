<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Collection;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository
{
    /**
     * @return Collection
     */
    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    /**
     * @param int $id
     * @return Post|null
     */
    public function getPostById(int $id): ?Post
    {
        return Post::find($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Post::where('id', $id)->update($data);
    }

    /**
     * @param array $data
     * @return Post
     */
    public function create(array $data) : Post
    {
        return Post::create($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool
    {
        return Post::where('id', $id)->delete();
    }
}
