<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Events\OnFinishSuccessRule;
use App\Services\AnnouncementService;

class OnFinishSuccessRuleListener
{
    public function __construct(
        readonly private AnnouncementService $service,
    ) {
    }

    public function handle(OnFinishSuccessRule $event): void
    {
        $this->service->logAnnouncementRule($event->getStat()->getAnnouncement(), $event->getRule());
    }
}
