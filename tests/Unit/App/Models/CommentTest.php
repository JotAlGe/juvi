<?php

namespace Tests\Unit\App\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test 
     */
    public function a_comment_belongs_to_user(): void
    {
        $user = User::factory()->createOne();
        $post = Post::factory()->createOne();
        $comments = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->assertInstanceOf(User::class, $comments->user);
    }
}
