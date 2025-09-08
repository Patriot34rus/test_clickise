<?php

namespace App\Regulator\Rules;

use App\Regulator\Exceptions\RegulatorConditionException;

class IfAndThenRule extends AbstractRule
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

        $conditionsDto = $this->ruleDto->getConditions();

        foreach ($conditionsDto as $conditionDto) {
            $isMet = $this->conditionFactory->createCondition($conditionDto->getOperator())->isMet($conditionDto);

            if (!$isMet) {
                return false;
            }
        }

        return true;
    }
}
