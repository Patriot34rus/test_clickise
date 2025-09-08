<?php
declare(strict_types=1);

namespace App\Regulator\Dto;

use Illuminate\Support\Collection;

class RuleDataDto
{
    public function __construct(
        private readonly Collection $conditions,
        private readonly ActionDto $action,
        private readonly DataDto $data
    ) {

    }

    /**
     * @return Collection | ConditionDto[]
     */
    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function getAction(): ActionDto
    {
        return $this->action;
    }

    public function getData(): DataDto
    {
        return $this->data;
    }
}
