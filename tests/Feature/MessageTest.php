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

    /**
     * @test
     */
    public function it_can_get_all_messages_by_admin(): void
    {
        $user = User::factory()->createOne([
            'role' => 'admin'
        ]);
        $messages = Message::factory()->times(2)->create();

        $this->actingAs($user)
            ->getJson(route('messages.index'))
            ->assertSuccessful()
            ->assertSee([
                $messages[0]->title,
                $messages[0]->body
            ]);

        $this->assertDatabaseCount('messages', 2);
    }

    /**
     * @test
     */
    public function it_cannot_get_all_messages_by_user(): void
    {
        $user = User::factory()->createOne([
            'role' => 'user'
        ]);

        $this->actingAs($user)
            ->getJson(route('messages.index'))
            ->assertStatus(403);
    }
}
