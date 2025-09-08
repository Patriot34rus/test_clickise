<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Filters\AnnouncementFilter;
use App\Http\Formatter\AnnouncementFormatter;
use App\Repositories\AnnouncementRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;

class AnnouncementController
{
    public function __construct(
        readonly private AnnouncementRepository $repository,
        readonly private AnnouncementFormatter $formater,
    ) {
    }

    public function getStats(Request $request): JsonResponse
    {
        $currentYear = \Illuminate\Support\Carbon::now()->year;
        $statsData = $this->repository->getStats($currentYear);
        $formatedData = $this->formater->formatStats($statsData);

        return response()->json($formatedData);
    }

    public function getLogs(Request $request): JsonResponse
    {
        $page = (int) $request->get('page', 0);
        $limit = 10;
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $announcement = (int) $request->get('announcement');

        $filter = new AnnouncementFilter(
            $page,
            $limit,
            $startDate ? Carbon::parse($startDate) : null,
            $endDate ? Carbon::parse($endDate) : null,
            $announcement
        );

        $logs = $this->repository->getLogs($filter);
        $count = $this->repository->getCountLogs();
        $formatedData = $this->formater->formatLogs($logs);

        return response()->json([
            'logs' => $formatedData,
            'count' => $count,
        ]);
    }

    public function getFilterData(Request $request): JsonResponse
    {
        $announcements = $this->repository->getDistinctAnnouncement();

        return response()->json(['announcements' => $announcements]);
    }
}
