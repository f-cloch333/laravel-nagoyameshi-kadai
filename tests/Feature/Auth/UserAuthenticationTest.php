<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーがホームページにアクセスできるかを確認するテスト
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);  // ステータスコード200が返ってくることを確認
    }

    /**
     * 正しい認証情報でログインできるかをテスト
     */
    public function test_users_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');  // ログイン後はホームにリダイレクトされることを確認
        $this->assertAuthenticatedAs($user);  // ログインが成功したことを確認
    }

    /**
     * 不正な認証情報でログインできないことを確認
     */
    public function test_users_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();  // エラーがセッションに存在することを確認
        $this->assertGuest();  // 認証されていないことを確認
    }
}
