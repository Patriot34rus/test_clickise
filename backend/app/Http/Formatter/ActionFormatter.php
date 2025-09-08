<?php
declare(strict_types=1);

namespace App\Http\Formatter;

use App\Models\RegulatorCondition;
use Illuminate\Support\Collection;

class ActionFormatter
{
    public function formatConditions(Collection $conditions): array
    {
        return $conditions->map(function ($condition) {
            return $this->formatCondition($condition);
        })->toArray();
    }

    public function formatCondition(RegulatorCondition $condition): array
    {
        return [
            'id' => $condition->getId(),
            'operator' => $condition->getOperator(),
            'parameterLeft' => $condition->getParameterLeft(),
            'parameterRight' => $condition->getParameterRight(),
            'value' => $condition->getValue(),
        ];
    }
}
