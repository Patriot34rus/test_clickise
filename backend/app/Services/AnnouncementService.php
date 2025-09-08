<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Announcement;
use App\Models\AnnouncementRuleLog;
use App\Models\AnnouncementStat;
use App\Models\RegulatorRule;
use App\Repositories\AnnouncementRepository;
use App\Repositories\AnnouncementStatRepository;
use Carbon\Carbon;

class AnnouncementService
{
    public function __construct(
        readonly private AnnouncementRepository $repository,
        readonly private AnnouncementStatRepository $announcementStatRepository,
    ) {
    }

    public function decrementBudget(Announcement $announcement, float $decrementValue): bool
    {
        $newBudget = $announcement->getBudget() - $decrementValue;
        $announcement->setBudget($newBudget);

        return $this->repository->save($announcement);
    }

    public function incrementBudget(Announcement $announcement, float $incrementValue): bool
    {
        $newBudget = $announcement->getBudget() + $incrementValue;
        $announcement->setBudget($newBudget);

        return $this->repository->save($announcement);
    }

    public function decrementCPM(Announcement $announcement, float $decrementValue): bool
    {
        $newCpm = $announcement->getCpm() - $decrementValue;
        $announcement->setCpm($newCpm);

        return $this->repository->save($announcement);
    }

    public function incrementCPM(Announcement $announcement, float $incrementValue): bool
    {
        $newCpm = $announcement->getCpm() + $incrementValue;
        $announcement->setCpm($newCpm);

        return $this->repository->save($announcement);
    }

    public function resetBudget(Announcement $announcement): bool
    {
        $announcement->setCpm(0);

        return $this->repository->save($announcement);
    }

    public function deactivateStat(AnnouncementStat $announcementStat): bool
    {
        $announcementStat->setStatus(AnnouncementStat::STATUS_NOT_ACTIVE);

        return $this->announcementStatRepository->save($announcementStat);
    }

    public function logAnnouncementRule(Announcement $announcement, RegulatorRule $rule): bool
    {
        // не стал заморачиваться с новым репозиторием
        $log = new AnnouncementRuleLog();
        $log
            ->setBudget($announcement->getBudget())
            ->setCpm($announcement->getCpm())
            ->setDate(Carbon::now()->toDateTimeImmutable());
        $log->announcement()->associate($announcement);
        $log->rule()->associate($rule);

        return $log->save();
    }
}
