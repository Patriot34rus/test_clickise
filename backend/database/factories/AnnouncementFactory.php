<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class Announcement2Factory extends Factory
{
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'cpm' => $this->faker->randomFloat(2),
            'budget' => $this->faker->randomFloat(2),
            'status' => $this->faker->randomNumber(1),
            'name' => $this->faker->name,
        ];
    }
}
