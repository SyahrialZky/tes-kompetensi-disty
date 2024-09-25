<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        // Dummy user testing
        $this->user = User::create([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);
    }

    /** @test */
    public function test_user_can_login_with_valid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'password',
        ]);

        // Assert redirect ke dashboard
        $response->assertRedirect('/dashboard');

        // Assert session regeneration dan authentikasi user
        $this->assertAuthenticatedAs($this->user);
    }

    /** @test */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'wrongpassword',
        ]);

        // Assert redirect back ke login
        $response->assertSessionHasErrors('email');

        // Assert user tidak terautentikasi
        $this->assertGuest();
    }

    /** @test */
    public function test_login_requires_email_and_password()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        // Assert validasi error
        $response->assertSessionHasErrors(['email', 'password']);

        // Assert user tidak terautentikasi
        $this->assertGuest();
    }
}
