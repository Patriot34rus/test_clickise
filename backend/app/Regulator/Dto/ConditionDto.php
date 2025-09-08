<?php
declare(strict_types=1);

namespace App\Regulator\Dto;

use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Enum\RuleConditionOperatorEnum;

class ConditionDto
{
    public function __construct(
        private readonly string $operator,
        private readonly int|float $parameterLeft,
        private readonly int|float $parameterRight,
    ) {

    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getParameterLeft(): int|float
    {
        return $this->parameterLeft;
    }

    public function getParameterRight(): int|float
    {
        return $this->parameterRight;
    }
}
