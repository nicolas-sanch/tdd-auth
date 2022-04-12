<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function when_a_user_gives_his_credentials_he_is_authenticated()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post('/login', $credentials)->assertRedirect(route('dashboard'));

        $this->assertEquals(auth()->id(), $user->id);
    }
}
