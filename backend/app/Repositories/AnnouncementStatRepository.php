<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\AnnouncementStat;
use Illuminate\Support\Collection;

class AnnouncementStatRepository
{
    public function __construct(
        readonly private AnnouncementStat $model
    ) {
    }

    /**
     * @return Collection | AnnouncementStat[]
     */
    public function getAllActive(): Collection
    {
        return $this->model->with('announcement')->where('status', '=', 0)->get();
    }

    public function save(AnnouncementStat $announcementStat): bool
    {
        return $announcementStat->save();
    }


}
