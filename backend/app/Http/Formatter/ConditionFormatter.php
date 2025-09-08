<?php
declare(strict_types=1);

namespace App\Http\Formatter;

use App\Models\RegulatorRule;
use Illuminate\Support\Collection;

class ConditionFormatter
{
    public function formatRules(Collection $rules): array
    {
        return $rules->map(function ($rule) {
            return $this->formatRule($rule);
        })->toArray();
    }

    public function formatRule(RegulatorRule $rule): array
    {
        return [
            'name' => $rule->getName(),
            'pattern' => $rule->getPattern(),
            'conditions' => $rule->getConditions(),
            'action' => $rule->getAction(),
        ];
    }
}
