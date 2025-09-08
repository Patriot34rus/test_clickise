<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegulatorCondition;
use App\Models\RegulatorRule;
use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Enum\RuleTypeEnum;
use Illuminate\Support\Collection;

class RegulatorRuleRepository
{
    public function __construct(
        readonly private RegulatorRule $model
    ) {
    }

    /**
     * @return Collection<RegulatorRule> | RegulatorRule[]
     */
    public function getAll(): Collection
    {
        return $this->model->get();
    }

    /**
     * @return Collection<RegulatorRule> | RegulatorRule[]
     */
    public function getAllWithConditionsAndActions(): Collection
    {
        return $this->model->with(['conditions', 'action'])->get();
    }

    public function getById(int $id): ?RegulatorRule
    {
        return $this->model->find($id);
    }

    public function save(RegulatorRule $rule): bool
    {
        return $rule->save();
    }

    public function saveCondition(RegulatorCondition $condition): bool
    {
        return $condition->save();
    }

    public function createRule(string $name, RuleTypeEnum $pattern): ?RegulatorRule
    {
        $rule = (new RegulatorRule())
            ->setName($name)
            ->setPattern($pattern);

        return $this->save($rule) ? $rule : null;
    }

    public function createCondition(
        RuleConditionOperatorEnum $operator,
        RuleParametersEnum $parameterRight,
        RuleParametersEnum $parameterLeft,
        ?float $value = null,
    ): ?RegulatorCondition {
        $condition = (new RegulatorCondition())
            ->setParameterRight($parameterRight)
            ->setParameterLeft($parameterLeft)
            ->setOperator($operator)
            ->setValue($value);

        return $this->saveCondition($condition) ? $condition : null;
    }
}
