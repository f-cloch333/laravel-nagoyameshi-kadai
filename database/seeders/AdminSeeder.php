<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

    // 課題閲覧用管理者アカウント
        $admin2 = new Admin();
        $admin2->email = 'adomi2@example.com';
        $admin2->password = Hash::make('nagoyameshi2');
        $admin2->save();    
    }
}
