<?php
declare(strict_types=1);

namespace App\Http\Formatter;

use App\Models\RegulatorAction;

class ActionFormatter
{
    public function formatAction(RegulatorAction $action): array
    {
        return [
            'id' => $action->getId(),
            'parameter' => $action->getParameter(),
            'type' => $action->getType(),
            'value' => $action->getValue(),
        ];
    }
}
