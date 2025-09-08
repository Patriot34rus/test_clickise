<?php
declare(strict_types=1);

namespace App\Regulator;

use App\Models\Announcement;
use App\Models\RegulatorAction;
use App\Regulator\Actions\ActionInterface;
use App\Regulator\Actions\DecrementAction;
use App\Regulator\Actions\DecrementWithConstraintBudgetAction;
use App\Regulator\Actions\IncrementAction;
use App\Regulator\Dto\ActionDto;
use App\Regulator\Enum\RuleActionEnum;
use App\Regulator\Exceptions\RegulatorActionException;
use App\Services\AnnouncementService;

class ActionFactory
{
    public function __construct(readonly private AnnouncementService $announcementService)
    {
    }

    public function createAction(
        string $actionType,
    ): ActionInterface {
        return match ($actionType) {
            RuleActionEnum::INCREMENT->value => new IncrementAction($this->announcementService),
            RuleActionEnum::DECREMENT->value => new DecrementAction($this->announcementService),
            RuleActionEnum::DECREMENT_WITH_CONSTRAINT_BUDGHET->value => new DecrementWithConstraintBudgetAction(
                $this->announcementService
            ),
            default => throw new RegulatorActionException(sprintf('Unknown action %s.', $actionType))
        };
    }

    public function createActionDto(Announcement $announcement, RegulatorAction $action): ActionDto
    {
        return new ActionDto($announcement, $action->getType(), $action->getParameter(), $action->getValue());
    }
}
