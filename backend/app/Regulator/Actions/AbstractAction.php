<?php
declare(strict_types=1);

namespace App\Regulator\Actions;

use App\Services\AnnouncementService;

abstract class AbstractAction implements ActionInterface
{
    public function __construct(readonly protected AnnouncementService $service)
    {
    }
}
