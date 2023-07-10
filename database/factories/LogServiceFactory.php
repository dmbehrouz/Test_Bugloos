<?php

namespace Database\Factories;

use App\Models\LogService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogServiceFactory extends Factory
{
    use RefreshDatabase;
    protected $model = LogService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $counter = 0;
        $startDate = Carbon::create(2023, 7, 1, 10, 50, 0);
        $endDate = Carbon::create(2023, 7, 1, 10, 50, 10);
        $interval = $startDate->diffInSeconds($endDate) / 9;
        return [
            'service_name'      => $this->faker->name,
            'service_type_call' => $this->faker->name,
            'status_code'       => $this->faker->numberBetween(100,599),
            'execute_time'      => $startDate->addSeconds($counter++ * $interval),
            ];
    }

}
