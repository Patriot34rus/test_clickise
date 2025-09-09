<?php
declare(strict_types=1);

namespace App\Regulator;

use App\Models\RegulatorCondition;
use App\Regulator\Conditions\ConditionInterface;
use App\Regulator\Conditions\Equal;
use App\Regulator\Conditions\Greater;
use App\Regulator\Conditions\GreaterEqual;
use App\Regulator\Conditions\Less;
use App\Regulator\Conditions\LessEqual;
use App\Regulator\Conditions\NotEqual;
use App\Regulator\Dto\ConditionDto;
use App\Regulator\Dto\DataDto;
use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Exceptions\RegulatorActionException;
use Illuminate\Support\Collection;

class ConditionFactory
{
    /**
     * @throws RegulatorActionException
     */
    public function createCondition(
        string $operator
    ): ConditionInterface {
        return match ($operator) {
            RuleConditionOperatorEnum::EQUAL->value => new Equal(),
            RuleConditionOperatorEnum::LESS->value => new Less(),
            RuleConditionOperatorEnum::GREATER->value => new Greater(),
            RuleConditionOperatorEnum::NOT_EQUAL->value => new NotEqual(),
            RuleConditionOperatorEnum::LESS_EQUAL->value => new LessEqual(),
            RuleConditionOperatorEnum::GREATER_EQUAL->value => new GreaterEqual(),
            default => throw new RegulatorActionException('Unknown operator')
        };
    }

    /**
     * @return ConditionDto
     */
    public function createConditionDto(
        string $operatorEnum,
        int|float $parameterLeft,
        int|float $parameterRight,
    ): ConditionDto {
        return new ConditionDto($operatorEnum, $parameterLeft, $parameterRight);
    }

    /**
     * @param Collection| RegulatorCondition[] $condition
     * @return Collection| ConditionDto[]
     */
    public function createConditionDtoCollection(
        Collection $conditions,
        DataDto $dataDto
    ): Collection {
        return $conditions->map(function (RegulatorCondition $model) use ($dataDto) {

            $left = $dataDto->getParameterValue($model->getParameterLeft());

            $right = $model->getParameterRight() === RuleParametersEnum::CUSTOM_VALUE->value ?
                $model->getValue() :
                $dataDto->getParameterValue($model->getParameterRight());

            return $this->createConditionDto($model->getOperator(), $left, $right);
        });
    }
}
