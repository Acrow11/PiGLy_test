<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // ユーザーの作成
        $user = User::create([
            'name' => 'テストユーザー',
            'email' => $faker->unique()->safeEmail, // ランダムなメールアドレス
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // weight_logs のダミーデータを35件作成
        \App\Models\WeightLog::factory(35)->create([
            'user_id' => $user->id, // 作成したユーザーに紐づける
        ]);
    }
}
