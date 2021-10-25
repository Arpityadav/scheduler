<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Model;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'name' => $this->faker->name,
            'description' => $this->faker->text(500),
            'startTime' => $this->faker->time('10:10'),
            'endTime' => $this->faker->time('11:10'),
            'day' => $this->faker->dayOfWeek,
        ];
    }
}
