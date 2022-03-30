<?php

namespace Database\Seeders;

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
        //\App\Models\Role::factory(5)->create();
		$this->call([
			RoleSeeder::class,
			UserSeeder::class,
		]);
        //\App\Models\Company::factory(10)->create();
        //\App\Models\Project::factory(50)->create();
        //\App\Models\Task::factory(100)->create();
        //\App\Models\Task_comment::factory(50)->create();
    }
}
