<?php

namespace Tests\Unit\App\Models;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test 
     */
    public function a_post_belongs_to_user(): void
    {
        $user = User::factory()->createOne();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $post->user);
    }

    /**
     * @test
     */
    public function a_post_has_one_a_image(): void
    {
        $user = User::factory()->createOne();
        $post = Post::factory()->createOne([
            'user_id' => $user->id
        ]);
        $image = Image::factory()->createOne([
            'imageable_id' => $post->id,
            'imageable_type' => Post::class
        ]);

        $this->assertInstanceOf(Post::class, $image->imageable);
    }
}
