<?php
declare(strict_types=1);

namespace App\Http\Validators;

use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use App\Regulator\Enum\RuleTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class RuleValidator
{
    // тут должен быть нормальный класс валидатора или унести это в мидлваре
    public function validate(Request $request): bool
    {
        $request->validate(
            [
                'rule.name' => 'required',
                'rule.pattern' => [
                    'required',
                    'string',
                    new Enum(RuleTypeEnum::class),
                ],
                'rule.conditions.*.parameterLeft' => [
                    'required',
                    'string',
                    new Enum(RuleParametersEnum::class),
                ],
                'rule.conditions.*.parameterRight' => [
                    'required',
                    'string',
                    new Enum(RuleParametersEnum::class),
                ],
                'rule.conditions.*.operator' => [
                    'required',
                    'string',
                    new Enum(RuleConditionOperatorEnum::class),
                ],
            ],
        );

        return true;
    }
}
