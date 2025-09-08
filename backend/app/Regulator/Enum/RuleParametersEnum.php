<?php
declare(strict_types=1);

namespace App\Regulator\Enum;

enum RuleParametersEnum: string {
    case BUDGET = 'budget';
    case SPENT = 'spent';
    case CLICKS = 'clicks';
    case VIEWS = 'views';
    case CPM = 'cpm';
    case CUSTOM_VALUE = 'value';
}
