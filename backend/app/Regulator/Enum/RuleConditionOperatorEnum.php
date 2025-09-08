<?php
declare(strict_types=1);

namespace App\Regulator\Enum;

enum RuleConditionOperatorEnum: string
{
    case GREATER = '>';
    case LESS = '<';
    case EQUAL = '=';
    case NOT_EQUAL = '!=';
    case GREATER_EQUAL = '>=';
    case LESS_EQUAL = '<=';
}
