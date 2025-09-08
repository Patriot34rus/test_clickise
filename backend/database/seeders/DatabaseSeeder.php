<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementStat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Announcement::factory()->count(3)->has(AnnouncementStat::factory()->count(10))->create();
    }
}
