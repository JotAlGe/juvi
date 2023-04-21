<?php

namespace Tests\Unit\App\Models;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function a_message_belongs_to_user(): void
    {
        $user = User::factory()->createOne();
        $message = Message::factory()->createOne([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(User::class, $message->user);
    }
}
