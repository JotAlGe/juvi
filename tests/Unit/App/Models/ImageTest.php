<?php

namespace Tests\Unit\App\Models;

use App\Models\Image;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function a_image_belongs_to_user(): void
    {
        $user = User::factory()->createOne();
        $image = Image::factory()->createOne([
            'imageable_id' => $user->id,
            'imageable_type' => User::class,
        ]);

        $this->assertInstanceOf(Image::class, $user->image);
    }

    /**
     * @test
     */
    public function a_image_belongs_to_post(): void
    {
        $user = User::factory()->createOne();
        $post = Post::factory()->createOne(['user_id' => $user->id]);
        $image = Image::factory()->createOne([
            'imageable_id' => $post->id,
            'imageable_type' => Post::class,
        ]);

        $this->assertInstanceOf(Image::class, $post->image);
    }

    /**
     * @test
     */
    public function a_image_belongs_to_project(): void
    {
        $user = User::factory()->createOne();
        $project = Project::factory()->createOne(['user_id' => $user->id]);
        $image = Image::factory()->createOne([
            'imageable_id' => $project->id,
            'imageable_type' => Project::class,
        ]);

        $this->assertInstanceOf(Image::class, $project->image);
    }
}
