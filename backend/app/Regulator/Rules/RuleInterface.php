<?php

namespace App\Regulator\Rules;

use App\Regulator\Exceptions\RegulatorActionException;
use App\Regulator\Exceptions\RegulatorConditionException;

interface RuleInterface
{
    /**
     * @throws RegulatorConditionException
     */
    public function isMetConditions(): bool;

    /**
     * @throws RegulatorActionException
     */
    public function execAction(): bool;
}
