<?php

namespace Tests\Feature\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateComment()
    {
        $response = $this->postJson('/api/comment', [
            'message' => 'Test message',
        ]);

        $response->assertStatus(200);
    }
}
