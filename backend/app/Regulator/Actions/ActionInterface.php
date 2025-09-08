<?php
declare(strict_types=1);

namespace App\Regulator\Actions;

use App\Regulator\Dto\ActionDto;

interface ActionInterface
{
    public function execute(ActionDto $actionDto): bool;

}
