<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // コンストラクタでミドルウェアの設定（管理者用）
    public function __construct()
     {
        $this->middleware('auth');  // 認証済みユーザーのみアクセス可能にする
        $this->middleware('can:admin'); // admin権限を持つユーザーのみアクセス
    }

    // 会員一覧ページ
    public function index(Request $request)
    {
        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // ユーザーを検索する場合、氏名またはフリガナで部分一致検索
        $usersQuery = User::query();

        if ($keyword) {
            $usersQuery->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                      ->orWhere('kana', 'like', '%' . $keyword . '%');
            });
         }

        // ページネーションを適用（例: 10件表示）
        $users = $usersQuery->paginate(10);

        // 総数を取得
        $total = $usersQuery->count();

        // 会員一覧ビューを返す
        return view('admin.users.index', compact('users', 'keyword', 'total'));
        }

        // 会員詳細ページ
        public function show($id)
         {
        // ユーザー情報を取得
        $user = User::findOrFail($id);

        // 会員詳細ビューを返す
        return view('admin.users.show', compact('user'));
         }
}