<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\AnnouncementStat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnnouncementStatFactory extends Factory
{
    protected $model = AnnouncementStat::class;

    public function definition()
    {
        $currentYear = Carbon::now()->year;
        $startDate = Carbon::create($currentYear, 1, 1, 0, 0, 0);
        $endDate = Carbon::create($currentYear, 12, 31, 23, 59, 59);

        return [
            'announcement_id' => Announcement::factory(),
            'views' => $this->faker->randomNumber(3),
            'clicks' => $this->faker->randomNumber(3),
            'spent' => $this->faker->randomNumber(3),
            'status' => $this->faker->randomElement([0, 1]),
            'date' => $this->faker->dateTimeBetween($startDate, $endDate),
        ];
    }
}
