<?php

namespace App\Regulator\Rules;

use App\Regulator\Exceptions\RegulatorConditionException;

class IfThenRule extends AbstractRule
{
    /**
     * @inheritDoc
     */
    public function isMetConditions(): bool
    {
        if (!$this->ruleDto) {
            throw new RegulatorConditionException(
                'RuleData not found. Please, use setRuleData() before running isMetConditions method'
            );
        }

        $conditionDto = $this->ruleDto->getConditions()[0];

        return $this->conditionFactory->createCondition($conditionDto->getOperator())->isMet($conditionDto);
    }
}
