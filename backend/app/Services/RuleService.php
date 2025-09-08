<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SystemBaseException;
use App\Models\RegulatorAction;
use App\Models\RegulatorCondition;
use App\Models\RegulatorRule;
use App\Regulator\Enum\RuleActionEnum;
use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Enum\RuleTypeEnum;
use App\Repositories\RegulatorRuleRepository;

class RuleService
{
    public function __construct(
        readonly private RegulatorRuleRepository $ruleRepository,
    ) {
    }

    /**
     * @throws SystemBaseException
     */
    public function createRule(RuleTypeEnum $pattern, string $name): RegulatorRule
    {
        $rule = $this->ruleRepository->createRule($name, $pattern);
        if ($rule) {
            return $rule;
        }

        throw new SystemBaseException(sprintf('Can not create rule %s', $name));
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

    public function createAction(
        RuleActionEnum $actionType,
        RuleParametersEnum $parameter,
        ?float $value = null,
    ): RegulatorAction {
        $action = (new RegulatorAction())
            ->setParameter($parameter)
            ->setType($actionType)
            ->setValue($value);

        return $action;
    }

    public function updateRule(RegulatorRule $rule, array $requestData): bool
    {
        $rule->setName($requestData['name'])
            ->setPattern(RuleTypeEnum::from($requestData['pattern']));

        $conditions = [];

        foreach ($requestData['conditions'] as $condition) {
            $conditions[] = $this->createCondition(
                RuleConditionOperatorEnum::tryFrom($condition['operator']),
                RuleParametersEnum::tryFrom($condition['parameterRight']),
                RuleParametersEnum::tryFrom($condition['parameterLeft']),
                (float) $condition['value']
            );
        }

        $rule->conditions()->delete();
        $rule->conditions()->saveMany($conditions);

        $action = $this->createAction(
            RuleActionEnum::from($requestData['action']['type']),
            RuleParametersEnum::from($requestData['action']['parameter']),
            (float) $requestData['action']['value']
        );

        $rule->action()->delete();
        $rule->action()->save($action);

        return true;
    }
}
