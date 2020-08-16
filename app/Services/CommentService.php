<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getMainComments(int $postId)
    {
        return $this->commentRepository->getMainByPostId($postId);
    }
}
