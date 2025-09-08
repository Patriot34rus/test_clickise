<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'cpm' => $this->faker->randomFloat(2, 10, 1000),
            'budget' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement([0, 1]),
            'name' => $this->faker->name,
        ];
    }
}
