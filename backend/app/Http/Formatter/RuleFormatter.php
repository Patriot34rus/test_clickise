<?php
declare(strict_types=1);

namespace App\Http\Formatter;

use App\Models\RegulatorRule;
use Illuminate\Support\Collection;

class RuleFormatter
{
    public function __construct(
        private ConditionFormatter $conditionFormatter,
        private ActionFormatter $actionFormatter
    ) {
    }

    public
    function formatRules(
        Collection $rules
    ): array {
        return $rules->map(function ($rule) {
            return $this->formatRule($rule);
        })->toArray();
    }

    public
    function formatRule(
        RegulatorRule $rule
    ): array {
        $action = $rule->getAction();

        return [
            'id' => $rule->getId(),
            'name' => $rule->getName(),
            'pattern' => $rule->getPattern(),
            'conditions' => $this->conditionFormatter->formatConditions($rule->getConditions()),
            'action' => $action ? $this->actionFormatter->formatAction($action) : null,
        ];
    }
}
