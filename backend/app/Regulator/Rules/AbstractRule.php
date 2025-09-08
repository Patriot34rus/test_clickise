<?php
declare(strict_types=1);

namespace App\Regulator\Rules;

use App\Regulator\ActionFactory;
use App\Regulator\ConditionFactory;
use App\Regulator\Dto\RuleDataDto;

abstract class AbstractRule implements RuleInterface
{
    protected RuleDataDto $ruleDto;

    public function __construct(
        readonly ConditionFactory $conditionFactory,
        readonly ActionFactory $actionFactory
    ) {
    }

    public function setRuleDataDto(
        RuleDataDto $ruleDataDto
    ): void {
        $this->ruleDto = $ruleDataDto;
    }

    /**
     * @inheritDoc
     */
    public function execAction(): bool
    {
        $type = $this->ruleDto->getAction()->getActionType();

        return $this->actionFactory->createAction($type)->execute($this->ruleDto->getAction());
    }
}
