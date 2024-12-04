<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(100)->create();
        ser::create([
        'name' => '一般ユーザー',
        'email' => 'user@example.com',
        'password' => Hash::make('password123'), // パスワードはハッシュ化
        'postal_code' => '1234567',
        'address' => '東京都',
        'phone_number' => '08012345678',
        'birthday' => '1990-01-01',
        'occupation' => '会社員',
    ]);

    }
}
