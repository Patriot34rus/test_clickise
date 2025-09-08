<?php
declare(strict_types=1);

namespace App\Regulator\Enum;

enum RuleActionEnum: string
{
    case INCREMENT = 'increment';
    case DECREMENT = 'decrement';
    case DECREMENT_WITH_CONSTRAINT_BUDGHET = 'decrement_with_constraint_budget';
}
