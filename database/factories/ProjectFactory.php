<?php

namespace Database\Factories;

use App\Models\ {
    User,
    Project
};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectFactory extends Factory
{
    use WithFaker;

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
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(4),
            'owner_id' => function() {
                return User::factory()->create()->id;
            }
        ];
    }
}
