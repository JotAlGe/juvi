<?php

namespace Tests\Unit\App\Models;

use App\Models\Image;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function a_project_belongs_to_user(): void
    {
        $user = User::factory()->createOne();
        $project = Project::factory()->createOne(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $project->user);
    }

    /**
     * @test
     */
    public function a_project_has_one_a_image(): void
    {
        $user = User::factory()->createOne();
        $project = Image::factory()->createOne([
            'imageable_id' => $user->id,
            'imageable_type' => User::class
        ]);

        $this->assertInstanceOf(User::class, $project->imageable);
    }
}
