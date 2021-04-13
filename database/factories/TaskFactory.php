<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->word(10),
            'description' => $this->faker->text(30),
            'project_id' => Project::all()->random()->id,
            'user_created_id'    =>   $this->faker->randomElement([1,2,3]),
            'user_assigned_id'    =>  User::all()->random()->id,
            
        ];
    }
}
