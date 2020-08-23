<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{
    /**
     *
     */
    const LIMIT = 10;

    /**
     * @param int $id
     * @return mixed
     */
    public function getMainByPostId(int $id)
    {
        return Comment::where('post_id', $id)->where('main', 1)->paginate(self::LIMIT);
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getCountSubComments(array $ids): array
    {
        return Comment::select(DB::raw('count(*) as count'), 'main_id')->whereIn('main_id', $ids)
            ->groupBy('main_id')->get()->keyBy('main_id')->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getSubCommentsByMainId(int $id): array
    {
        return Comment::where('main_id', $id)->get()->toArray();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return Comment::where('id', $id)->delete();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteByMainId(int $id): bool
    {
        return Comment::where('main_id', $id)->delete();
    }

    /**
     * @param $id
     * @return Comment|null
     */
    public function getById($id): ?Comment
    {
        return Comment::find($id);
    }

    /**
     * @param int $oldId
     * @param int $newId
     * @return mixed
     */
    public function updateParentId(int $oldId, int $newId)
    {
        return Comment::where('parent_id', $oldId)->update([
            'parent_id' => $newId
        ]);
    }

    public function create(array $data): ?Comment
    {
        return Comment::create($data);
    }
}
