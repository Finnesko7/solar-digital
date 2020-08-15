<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function show($id)
    {
        $post = $this->postRepository->getPostById($id);
        return response()->json($post);
    }

    public function all()
    {
        $posts = $this->postRepository->getAllPosts();
        return response()->json($posts);
    }
}
