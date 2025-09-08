<?php
declare(strict_types=1);

namespace App\Regulator\Conditions;

use App\Regulator\Dto\ConditionDto;

class LessEqual implements ConditionInterface
{
    public function isMet(ConditionDto $condition) : bool
    {
        return $condition->getParameterLeft() <= $condition->getParameterRight();
    }
}
