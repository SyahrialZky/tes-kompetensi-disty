<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserEditTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat user dummy untuk pengujian
        $this->user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);
    }

    /** @test */
    public function test_user_edit_requires_name_email_and_role()
    {
        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->put(route('users.update', $this->user->id), []);

        // Assert validasi error
        $response->assertSessionHasErrors(['name', 'email', 'role']);
    }

    /** @test */
    public function test_user_edit_requires_valid_email()
    {
        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->put(route('users.update', $this->user->id), [
                'name' => 'John Doe',
                'email' => 'invalid-email',
                'role' => 'admin',
            ]);

        // Assert validasi error untuk email
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function test_user_edit_requires_valid_role()
    {
        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->put(route('users.update', $this->user->id), [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'invalid-role', // Invalid role
            ]);

        // Assert validasi error untuk role
        $response->assertSessionHasErrors(['role']);
    }
}
