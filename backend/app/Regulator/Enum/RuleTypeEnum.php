<?php
declare(strict_types=1);

namespace App\Regulator\Enum;

enum RuleTypeEnum: string
{
    case IF_THEN = 'if_then';
    case IF_AND_THEN = 'if_and_then';
    case IF_OR_THEN = 'if_or_then';
}
