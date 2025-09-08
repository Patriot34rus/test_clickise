<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\AnnouncementStat;
use Illuminate\Support\Collection;

class AnnouncementRepository
{
    public function __construct(
        readonly private AnnouncementStat $model
    ) {
    }

    /**
     * @return Collection | AnnouncementStat[]
     */
    public function getAll(): Collection
    {
        return $this->model->with(Announcement::class)->all();
    }
}
