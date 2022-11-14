<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start_date = Carbon::parse(fake()->dateTimeBetween('-1 year', '+2 months'));

        $day = rand(1,30);
        $end_date = $start_date->copy()->addDays($day);

        return [
            'title' => fake()->sentence(),
            'description' => implode('\n\r ', fake()->paragraphs()),
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];
    }
}
