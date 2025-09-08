<?php
declare(strict_types=1);

namespace App\Events;

use App\Models\AnnouncementStat;
use App\Models\RegulatorRule;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnFinishSuccessRule
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        readonly private RegulatorRule $rule,
        readonly private AnnouncementStat $stat
    ) {
    }

    public function getRule(): RegulatorRule
    {
        return $this->rule;
    }

    public function getStat(): AnnouncementStat
    {
        return $this->stat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
