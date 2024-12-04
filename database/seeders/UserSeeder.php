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

         $user = new User();
         $user->name = "田中太郎";
         $user->kana = "タナカタロウ";
         $user->email = 'tarou1204@example.com';
         $user->email_verified_at = Carbon::now();
         $user->password = Hash::make('password');
         $user->postal_code = "101-0022";
         $user->address = "東京都";
         $user->phone_number = "090-5554-1118";
         $user->save();
    }
}
