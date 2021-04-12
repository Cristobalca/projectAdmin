<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence,
            'description' => $this->faker->text(50),
            'status'      => $this->faker->randomElement(['comenzado','en_proceso','Terminado']),
            'user_assigned_id'=> $this->faker->randomElement([1,2,3]),
            'created_at'  => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
