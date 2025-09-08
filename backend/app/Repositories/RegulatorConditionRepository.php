<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegulatorCondition;
use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use Illuminate\Support\Collection;

class RegulatorConditionRepository
{
    public function __construct(
        readonly private RegulatorCondition $model
    ) {
    }

    /**
     * @return Collection<RegulatorCondition> | RegulatorCondition[]
     */
    public function getAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * @return Collection<RegulatorCondition> | RegulatorCondition[]
     */
    public function getAllWithRules(): Collection
    {
        return $this->model->with('rule')->get();
    }

    public function save(RegulatorCondition $condition): bool
    {
        return $condition->save();
    }

    public function createCondition(
        RuleConditionOperatorEnum $operator,
        RuleParametersEnum $parameterRight,
        RuleParametersEnum $parameterLeft,
        ?float $value = null,
    ): RegulatorCondition {
        $condition = (new RegulatorCondition())
            ->setParameterRight($parameterRight)
            ->setParameterLeft($parameterLeft)
            ->setOperator($operator)
            ->setValue($value);

        return $condition;
    }
}
