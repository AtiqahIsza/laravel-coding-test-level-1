<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition()
    {
        $startDate = Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-1 week', '+1 week')->getTimestamp());
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHour();
        
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->text(),
            'start_at' => $startDate,
            'end_at' => $endDate 
        ];
    }
}
