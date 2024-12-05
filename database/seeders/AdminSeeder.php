<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin@example.comが既に存在しているかチェック
        if (!Admin::where('email', 'admin@example.com')->exists()) {
            $admin = new Admin();
            $admin->email = 'admin@example.com';
            $admin->password = Hash::make('nagoyameshi');
            $admin->save();
        }

        // admin2@example.comが存在していなければ登録
        if (!Admin::where('email', 'admin2@example.com')->exists()) {
            $admin2 = new Admin();
            $admin2->email = 'admin2@example.com';
            $admin2->password = Hash::make('nagoyameshi2');
            $admin2->save();
        }
    }
}
