<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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

    public function update(PostRequest $request, $id)
    {
        $status = 200;
        $result = $this->postRepository->update($id, $request->all());

        if (!$result) $status = 201;

        return response()->json($request->all(), $status);
    }

    public function store(PostRequest $request)
    {
        $post = $this->postRepository->create($request->all());

        return response()->json($post);
    }

    public function destroy($id)
    {
        $status = 200;
        $result = $this->postRepository->delete($id);
        if (!$result) $status = 404;

        return response()->json([
           'success' => $result
        ], $status);
    }
}
