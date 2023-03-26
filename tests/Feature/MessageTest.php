<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function a_user_can_send_a_message(): void
    {
        $user = User::factory()->createOne();


        $this->actingAs($user)
            ->postJson(route('messages.store'), [
                'title' => 'A title',
                'body' => 'A description',
                'user_id' => $user->id
            ])
            ->assertCreated();
        // dd(JWTAuth::user()->id);
    }

    /**
     * @test
     */
    public function a_user_can_update_a_message(): void
    {
        $user = User::factory()->createOne();
        $message = Message::factory()->createOne();

        $this->actingAs($user)
            ->putJson(route('messages.update', $message), [
                'title' => 'A title updated',
                'body' => 'A description updated',
                'user_id' => $user->id
            ])
            ->assertCreated();

        $this->assertDatabaseHas('messages', [
            'title' => 'A title updated',
            'body' => 'A description updated',
            'user_id' => $user->id
        ]);
    }
}
