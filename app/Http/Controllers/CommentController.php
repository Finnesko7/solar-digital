<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Routing\Controller as BaseController;

class CommentController extends BaseController
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store()
    {
        // code ...
    }

    public function all($id)
    {
        return response()->json($this->commentService->getMainComments($id));
    }
}
