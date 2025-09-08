<?php
declare(strict_types=1);

namespace App\Regulator\Dto;

use App\Regulator\Enum\RuleParametersEnum;

class DataDto
{
    public function __construct(
        readonly private float $budget,
        readonly private float $cpm,
        readonly private int $views,
        readonly private int $clicks,
        readonly private float $spent
    ) {
    }

    public function getSpent(): float
    {
        return $this->spent;
    }

    public function getClicks(): int
    {
        return $this->clicks;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getCpm(): float
    {
        return $this->cpm;
    }

    public function getBudget(): float
    {
        return $this->budget;
    }

    public function getParameterValue(string $parameter)
    {
        $parameters = $this->toArray();

        if (!isset($parameters[$parameter])) {
            return null;
        }

        return $parameters[$parameter];
    }

    protected function toArray(): array
    {
        return [
            RuleParametersEnum::BUDGET->value => $this->getBudget(),
            RuleParametersEnum::SPENT->value => $this->getSpent(),
            RuleParametersEnum::CLICKS->value => $this->getClicks(),
            RuleParametersEnum::CPM->value => $this->getCpm(),
            RuleParametersEnum::VIEWS->value => $this->getViews(),
        ];
    }
}
