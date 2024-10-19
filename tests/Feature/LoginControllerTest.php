<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login'); // Kiểm tra view trả về
    }

    public function test_login()
    {
        // Giả định rằng bạn đã có một user trong database
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home'); // Kiểm tra redirect sau khi login
        $this->assertAuthenticatedAs($user); // Kiểm tra user đã đăng nhập
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $response = $this->post(route('login.post'), [
            'email' => 'wrong@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(); // Kiểm tra có lỗi trong session
        $this->assertGuest(); // Kiểm tra user chưa đăng nhập
    }
}
