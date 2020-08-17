<?php

namespace App\Services;

use App\Repositories\CommentRepository;

/**
 * Class CommentService
 * @package App\Services
 */
class CommentService
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentService constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $postId
     * @return mixed
     */
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

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $result = $this->commentRepository->deleteById($id);
        if ($result) $this->commentRepository->deleteByMainId($id);

        return $result;
    }

    /**
     * @param $id
     * @return array
     */
    public function getListSubComments($id) : array
    {
        $list = [];
        $comments = $this->commentRepository->getSubCommentsByMainId($id);
        foreach ($comments as $comment) {

            $this->setRecursive($list, $comment);

            if (isset($list[$comment['parent_id']]) && $comment) {
                $list[$comment['parent_id']]['comments'][] = $comment;
            } elseif ($comment) {
                $list[$comment['id']] = $comment;
            }
        }

        return $list;
    }

    /**
     * @param array $comments
     * @param array $data
     */
    private function setRecursive(array &$comments, array &$data)
    {
        foreach ($comments as $key => &$comment) {
            if (isset($comment['id']) && $comment['id'] == $data['parent_id']) {
                $comment['comments'][] = $data;
                $data = null;
            } elseif (isset($comment['comments'])) {
                $this->setRecursive($comment['comments'], $data);
            }
        }
    }


    /**
     * @param $id
     * @return bool
     */
    public function deleteSub($id) : bool
    {
        $result = false;
        $comment = $this->commentRepository->getById($id);

        if ($comment->id) {
            $this->commentRepository->updateParentId($comment->id, $comment->parent_id);

            $result = $this->commentRepository->deleteById($comment->id);
        }

        return $result;
    }
}
