<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Http\Filters\AnnouncementFilter;
use App\Models\Announcement;
use App\Models\AnnouncementRuleLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AnnouncementRepository
{
    public function __construct(
        readonly private Announcement $model
    ) {
    }

    public function save(Announcement $announcement): bool
    {
        return $announcement->save();
    }

    public function getStats(int $year): Collection
    {
        $result = DB::select(
            '
                SELECT
                  created_at,
                  SUM(budget) AS total_budget,
                  SUM(cpm) AS total_cpm
                FROM
                  announcement_rule_logs
                WHERE
                  YEAR(created_at) = ?
                GROUP BY
                  created_at
                ORDER BY
                  created_at',
            [$year]
        );

        return new Collection($result);
    }

    public function getLogs(AnnouncementFilter $filter): Collection
    {
        $query = AnnouncementRuleLog::query()
            ->with('announcement', 'rule')
            ->orderBy('created_at', 'desc');

        if ($filter->getPage()) {
            $query
                ->limit($filter->getLimit())
                ->offset($filter->getOffset());
        }

        if ($filter->getAnnouncement()) {
            $query->where('announcement_id', '=', $filter->getAnnouncement());
        }

        if ($filter->getStartDate() && $filter->getEndDate()) {
            $query->whereBetween('created_at', [$filter->getStartDate(), $filter->getEndDate()]);
        }

        return $query->get();
    }

    public function getLogsCount(AnnouncementFilter $filter): int
    {
        $query = AnnouncementRuleLog::query()
            ->orderBy('created_at', 'desc');

        if ($filter->getAnnouncement()) {
            $query->where('announcement_id', '=', $filter->getAnnouncement());
        }

        if ($filter->getStartDate() && $filter->getEndDate()) {
            $query->whereBetween('created_at', [$filter->getStartDate(), $filter->getEndDate()]);
        }

        return $query->count();
    }

    public function getCountLogs(): int
    {
        return AnnouncementRuleLog::query()->count();
    }

    public function getDistinctAnnouncement(): Collection
    {
        return $this->model->distinct()
            ->pluck('name', 'id');
    }
}
