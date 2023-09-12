<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_form(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_duplication(): void
    {
        $user1 = User::make([
            'name' => 'Afzal',
            'email' => 'afzal001@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'Noor',
            'email' => 'afzal002@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_delete_user() {

        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);

    }

    public function test_it_stores_new_users() {

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

    }
}
