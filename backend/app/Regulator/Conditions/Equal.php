<?php
declare(strict_types=1);

namespace App\Regulator\Conditions;

use App\Regulator\Dto\ConditionDto;

class Equal implements ConditionInterface
{
    public function isMet(ConditionDto $condition) : bool
    {
        return $condition->getParameterLeft() === $condition->getParameterRight();
    }
}
