<?php

namespace Tests\Feature\Feature\Api;

use App\Models\Comment;
use App\Models\Post;
use Tests\TestCase;

/**
 * Class CommentTest
 * @package Tests\Feature\Feature\Api
 */
class CommentTest extends TestCase
{
    /**
     * Test create new main comment
     */
    public function testCreateMainComment()
    {
        $message = 'Test message';
        $post = factory(Post::class)->create();

        $response = $this->postJson('/api/comment',
            [
                'message' => $message,
                'post_id' => $post->id,
                'main' => 1
            ],
            [
                'Content-type' => 'application/json; charset=UTF-8'
            ]
        );

        $response->assertStatus(200);
        $response->assertJson([
            'id' => 1,
            'post_id' => $post->id,
            'main' => 1,
        ]);

        $comment = Comment::find(1);
        $this->assertTrue((bool)$comment->id);
    }

    /**
     * Test create new sub comment
     */
    public function testCreateSubComment()
    {
        $message = 'Test message sub comment';

        $mainComment = factory(Comment::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->postJson('/api/comment',
            [
                'message' => $message,
                'main_id' => $mainComment->id,
                'parent_id' => $mainComment->id,
                'post_id' => $post->id
            ],
            [
                'Content-type' => 'application/json; charset=UTF-8'
            ]
        );

        $response->assertStatus(200);
        $response->assertJson([
            'id' => 2,
            'message' => $message,
            'main_id' => $mainComment->id,
            'parent_id' => $mainComment->id,
            'post_id' => $post->id,
        ]);

        $comment = Comment::find(2);
        $this->assertTrue((bool)$comment->id);
    }

    /**
     * Test update comment
     */
    public function testUpdateComment()
    {
        $message = 'Update comment message';
        $parentId = rand(1, 100);
        $comment = factory(Comment::class)->create([
            'message' => $message,
            'post_id' => $parentId,
        ]);

        $url = sprintf('%s/%s', '/api/comment', $comment->id);
        $response = $this->putJson($url, [
            'message' => $message,
            'parent_id' => $parentId
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => 1,
            'message' => $message,
            'parent_id' => $parentId
        ]);
    }

    /**
     * Test delete comment
     */
    public function testDeleteComment()
    {
        $comment = factory(Comment::class)->create([
            'message' => 'Test message',
            'post_id' => rand(1, 100),
        ]);

        $response = $this->delete(sprintf('%s/%s', '/api/comment', $comment->id));
        $response->assertStatus(204);

        $deletedComment = Comment::find($comment->id);
        $this->assertTrue($deletedComment === null);
    }
}
