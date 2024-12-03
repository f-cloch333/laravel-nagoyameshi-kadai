<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 未ログインのユーザーは管理者側の会員一覧ページにアクセスできない
     *
     * @return void
     */
    public function test_guest_user_cannot_access_admin_users_index()
    {
        $response = $this->get(route('admin.users.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の会員一覧ページにアクセスできない
     *
     * @return void
     */
    public function test_regular_user_cannot_access_admin_users_index()
    {
        $user = User::factory()->create(); // 一般ユーザーを作成

        $response = $this->actingAs($user)->get(route('admin.users.index'));

        $response->assertForbidden(); // アクセス禁止
    }

    /**
     * ログイン済みの管理者は管理者側の会員一覧ページにアクセスできる
     *
     * @return void
     */
    public function test_admin_user_can_access_admin_users_index()
    {
        $admin = User::factory()->create([
            'is_admin' => true, // 管理者フラグ
        ]);

        $response = $this->actingAs($admin)->get(route('admin.users.index'));

        $response->assertOk(); // アクセス成功
    }

    /**
     * 未ログインのユーザーは管理者側の会員詳細ページにアクセスできない
     *
     * @return void
     */
    public function test_guest_user_cannot_access_admin_users_show()
    {
        $user = User::factory()->create(); // ダミーユーザー

        $response = $this->get(route('admin.users.show', $user->id));

        $response->assertRedirect(route('login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の会員詳細ページにアクセスできない
     *
     * @return void
     */
    public function test_regular_user_cannot_access_admin_users_show()
    {
        $user = User::factory()->create(); // 一般ユーザーを作成
        $targetUser = User::factory()->create(); // 詳細を表示するユーザー

        $response = $this->actingAs($user)->get(route('admin.users.show', $targetUser->id));

        $response->assertForbidden(); // アクセス禁止
    }

    /**
     * ログイン済みの管理者は管理者側の会員詳細ページにアクセスできる
     *
     * @return void
     */
    public function test_admin_user_can_access_admin_users_show()
    {
        $admin = User::factory()->create([
            'is_admin' => true, // 管理者フラグ
        ]);

        $targetUser = User::factory()->create(); // 詳細を表示するユーザー

        $response = $this->actingAs($admin)->get(route('admin.users.show', $targetUser->id));

        $response->assertOk(); // アクセス成功
    }
}
