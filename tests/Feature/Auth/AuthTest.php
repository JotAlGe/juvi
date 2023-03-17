<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use WithFaker, refreshDatabase;

    /**
     * @test
     */
    public function it_can_register_a_user(): void
    {
        $this->postJson(route('auth.register'), [
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
        ])
            ->assertCreated();

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @test
     */
    public function it_can_login_a_user(): void
    {

        $user = User::factory()->createOne();

        $this->actingAs($user)
            ->postJson(route('auth.login'), [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(200);
    }
}
