<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends BaseController
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = $this->postRepository->getPostById($id);
        return response()->json($post);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $posts = $this->postRepository->getAllPosts();
        return response()->json($posts);
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, $id)
    {
        $status = 200;
        $result = $this->postRepository->update($id, $request->all());

        if (!$result) $status = 201;

        return response()->json($request->all(), $status);
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post = $this->postRepository->create($request->all());

        return response()->json($post);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
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
