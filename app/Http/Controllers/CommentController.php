<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Illuminate\Routing\Controller as BaseController;

class CommentController extends BaseController
{
    private $commentService;
    private $commentRepository;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request)
    {
        $comment = $this->commentService->create($request->all());

        return response()->json($comment);
    }

    public function all($id)
    {
        return response()->json($this->commentService->getMainComments($id));
    }

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

    public function getSubComments($id)
    {
        $list = $this->commentService->getListSubComments($id);

        return response()->json($list);
    }

    public function destroySub($id)
    {
        response()->json([
            'success' => $this->commentService->deleteSub($id)
        ]);
    }
}
