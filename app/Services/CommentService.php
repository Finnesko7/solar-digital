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
        $comments = $this->commentRepository->getMainByPostId($postId);

        $ids = $comments->pluck('id')->toArray();
        $countSubComment = $this->commentRepository->getCountSubComments($ids);

        foreach ($comments as $comment) {
            $comment->count = $countSubComment[$comment->id]['count'] ?? 0;
        }

        return $comments;
    }

    public function delete(int $id): bool
    {
        $result = $this->commentRepository->deleteById($id);
        if ($result) $this->commentRepository->deleteByMainId($id);

        return $result;
    }

    public function getListSubComments($id)
    {
        $list = []; $test = [];
        $comments = $this->commentRepository->getSubCommentsByMainId($id);
        foreach ($comments as $comment) {

            $this->setRecursive($list, $comment);

            if (isset($list[$comment['parent_id']]) && $comment) {
                $list[$comment['parent_id']]['comments'] = $comment;
            } else {
                $list[$comment['id']] = $comment;
            }
        }
        return $list;
    }

    private function setRecursive(array &$comments, array &$data)
    {
        if (isset($comments['id'])) {
            if ($comments['id'] == $data['parent_id']) {
                $comments['comments'] = $data;
                $data = null;
            }
        } else {
            foreach ($comments as &$comment) {
                if ($comment['id'] == $data['parent_id']) {
                    $comment['comments'] = $data;
                } elseif (isset($comment['comments']) && is_array($comment['comments'])) {
                    $result = $this->setRecursive($comment['comments'], $data);

                    if ($result) {
                        break;
                    }
                }
            }
        }
    }
}
