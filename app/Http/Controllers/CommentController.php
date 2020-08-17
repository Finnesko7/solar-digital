<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
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
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentService $commentService, CommentRepository $commentRepository)
    {
        $this->commentService = $commentService;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request)
    {
        $comment = $this->commentRepository->create($request->all());

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
        $status = 200;
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
     * @param $id
     */
    public function destroySub($id)
    {
        response()->json([
            'success' => $this->commentService->deleteSub($id)
        ]);
    }
}
