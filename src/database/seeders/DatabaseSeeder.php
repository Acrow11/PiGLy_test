<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        // 35件のダミーデータを作成
        WeightLog::factory()->count(35)->create();// \App\Models\User::factory(10)->create();
    }
}
