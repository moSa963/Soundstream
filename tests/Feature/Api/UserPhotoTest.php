<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserPhotoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_update_his_profile_photo(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->post("api/account/profile/photo", [
            "photo" => UploadedFile::fake()->image("profileImage.png"),
        ]);

        $response->assertSuccessful();
        
        Storage::assertExists("user_photo/{$user->username}");

        $user->delete();

        Storage::assertMissing("user_photo/{$user->username}");
    }
}
