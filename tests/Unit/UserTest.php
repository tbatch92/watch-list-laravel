<?php

namespace Tests\Unit;

use App\Models\StreamingService;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    function test_user_can_save_streaming_service_selection()
    {
        $user = User::factory()->create();
        $streamingService = StreamingService::first();

        $this->assertEmpty($user->streamingServices);

        $this->actingAs($user)->put(route("update-settings"), [
            "streaming_services" => [$streamingService->id]
        ]);

        $user->refresh();

        $this->assertCount(1, $user->streamingServices);
        $this->assertTrue($user->streamingServices()->first()->is($streamingService));
    }
}
