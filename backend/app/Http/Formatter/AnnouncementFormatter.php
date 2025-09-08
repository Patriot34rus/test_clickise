<?php
declare(strict_types=1);

namespace App\Http\Formatter;

use App\Models\AnnouncementRuleLog;
use Illuminate\Support\Collection;

class AnnouncementFormatter
{
    public function formatStats(Collection $stats): array
    {
        $labels = $stats->pluck('created_at')->toArray();
        $budgetData = $stats->pluck('total_budget')->toArray();
        $cpmData = $stats->pluck('total_cpm')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                ['label' => 'Budget', 'backgroundColor' => '#f87979', 'data' => $budgetData],
                ['label' => 'CPM', 'backgroundColor' => '#7acbf9', 'data' => $cpmData],
            ],
        ];
    }

    public function formatLogs(Collection $logs)
    {
        return $logs->map(function (AnnouncementRuleLog $log) {
            $announcementName = $log->getAnnouncement()->getName();
            $ruleName = $log->getRule()->getName();

            return [
                'name' => $announcementName,
                'rule' => $ruleName,
                'budget' => $log->getBudget(),
                'cpm' => $log->getCpm(),
                'date' => $log->getDateTime()?->format('Y-m-d H:i:s'),
            ];
        });
    }
}
