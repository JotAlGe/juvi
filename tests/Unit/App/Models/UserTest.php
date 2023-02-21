<?php

namespace Tests\Unit\App\Models;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function a_user_has_many_messages(): void
    {
        $user = User::factory()->createOne();
        $message = Message::factory()->createOne([
            'user_id' => $user->id
        ]);

        $this->assertTrue($user->messages->contains($message));
    }

    /**
     * @test
     */
    public function a_user_has_many_projects(): void
    {
        $user = User::factory()->createOne();
        $project = Project::factory()->createOne([
            'user_id' => $user->id
        ]);

        $this->assertTrue($user->projects->contains($project));
    }

    /**
     * @test
     */
    public function a_user_has_many_posts(): void
    {
        $user = User::factory()->createOne();
        $posts = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertTrue($user->posts->contains($posts));
    }

    /**
     * @test
     */
    public function a_user_has_many_comments(): void
    {
        $user = User::factory()->createOne();
        $post = Post::factory()->createOne();
        $comments = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->assertTrue($user->comments->contains($comments));
    }

    /**
     * @test
     */
    public function a_user_has_one_a_image(): void
    {
        $user = User::factory()->createOne();
        $image = Image::factory()->createOne([
            'imageable_id' => $user->id,
            'imageable_type' => User::class
        ]);

        $this->assertInstanceOf(User::class, $image->imageable);
    }
}
