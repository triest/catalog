<?php

namespace Database\Seeders;

use App\Models\Good;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Good::factory(1000)->create();
        User::factory(1)->create();

    }
}
