<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends BaseController
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request)
    {
        $comment = $this->commentService->create($request->all());

        return response()->json($comment);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function all($id)
    {
        return response()->json($this->commentService->getMainComments($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $status = 204;
        $success = true;

        if (!$this->commentService->delete($id))
        {
            $success = false;
            $status = 404;
        }

        return response()->json([
            'success' => $success
        ], $status);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubComments($id)
    {
        $list = $this->commentService->getListSubComments($id);

        return response()->json($list);
    }

    /**
     * @param CommentRequest $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return response()->json($comment);
    }
}
