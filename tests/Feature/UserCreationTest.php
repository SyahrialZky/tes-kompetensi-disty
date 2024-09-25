<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_create_with_valid_data()
    {
        $response = $this->withoutMiddleware()
            ->post(route('users.store'), [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'password',
                'role' => 'petugas',
            ]);

        // Assert redirect to users index
        $response->assertRedirect(route('users.index'));

        // Assert user is created in the database
        $this->assertDatabaseHas('users', [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'petugas',
        ]);
    }


    /** @test */
    public function test_user_creation_requires_name_email_password_and_role()
    {
        $response = $this->withoutMiddleware()
            ->post(route('users.store'), []);

        // Assert validation errors
        $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
    }

    /** @test */
    public function test_user_creation_requires_valid_email()
    {
        $response = $this->withoutMiddleware()
            ->post(route('users.store'), [
                'name' => 'John Doe',
                'email' => 'invalid-email',
                'password' => 'password',
                'role' => 'admin',
            ]);

        // Assert validation error for email
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function test_user_creation_requires_password_to_be_at_least_six_characters()
    {
        $response = $this->withoutMiddleware()
            ->post(route('users.store'), [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => '123',
                'role' => 'petugas',
            ]);

        // Assert validation error for password
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function test_user_creation_requires_valid_role()
    {
        $response = $this->withoutMiddleware()
            ->post(route('users.store'), [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'role' => 'invalid-role', // Invalid role
            ]);

        // Assert validation error for role
        $response->assertSessionHasErrors(['role']);
    }
}
