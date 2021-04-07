<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        $this->call(CAPermissiosSeeder::class);
        
        User::create([
            'name' => 'Cristobal C. Acosta',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        User::factory(10)->create();
        Project::factory(10)->create();
        Task::factory(30)->create();


    }
}
