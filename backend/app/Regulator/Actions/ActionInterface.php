<?php
declare(strict_types=1);

namespace App\Regulator\Actions;

use App\Regulator\Dto\ConditionDto;

interface ActionInterface {
    public function isMet(ConditionDto $condition): bool;

}
