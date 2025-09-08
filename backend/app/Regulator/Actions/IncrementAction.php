<?php
declare(strict_types=1);

namespace App\Regulator\Actions;

use App\Regulator\Dto\ActionDto;
use App\Regulator\Enum\RuleParametersEnum;

class IncrementAction extends AbstractAction
{
    public function execute(ActionDto $actionDto): bool
    {
        $announcement = $actionDto->getAnnouncement();

        return match ($actionDto->getParameter()) {
            RuleParametersEnum::BUDGET->value => $this->service->incrementBudget($announcement, $actionDto->getValue()),
            RuleParametersEnum::CPM->value => $this->service->incrementCPM($announcement, $actionDto->getValue()),
        };
    }
}
