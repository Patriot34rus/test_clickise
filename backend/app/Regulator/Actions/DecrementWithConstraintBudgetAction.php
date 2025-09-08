<?php
declare(strict_types=1);

namespace App\Regulator\Actions;

use App\Regulator\Dto\ActionDto;
use App\Regulator\Enum\RuleParametersEnum;
use App\Repositories\AnnouncementRepository;

class DecrementWithConstraintBudgetAction extends DecrementAction
{
    public function execute(ActionDto $actionDto): bool
    {
        $announcement = $actionDto->getAnnouncement();
        $isBudget = $actionDto->getParameter() === RuleParametersEnum::BUDGET->value;
        $isBelowZero = ($announcement->getBudget() - $actionDto->getValue()) < 0;

        if ($isBudget && $isBelowZero) {
            return $this->service->resetBudget($announcement);
        }

        return parent::execute($actionDto);
    }
}
