<?php
declare(strict_types=1);

namespace App\Models;

use App\Regulator\Enum\RuleConditionOperatorEnum;
use App\Regulator\Enum\RuleParametersEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegulatorCondition extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getParameterLeft(): string
    {
        return $this->parameter_left;
    }

    public function setParameterLeft(RuleParametersEnum $parameterLeft): self
    {
        $this->parameter_left = $parameterLeft->value;

        return $this;
    }

    public function getParameterRight(): string
    {
        return $this->parameter_right;
    }

    public function setParameterRight(RuleParametersEnum $parameterRight): self
    {
        $this->parameter_right = $parameterRight->value;

        return $this;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function setOperator(RuleConditionOperatorEnum $operator): self
    {
        $this->operator = $operator->value;

        return $this;
    }

    public function getValue(): ?float
    {
        return (float) $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function rule(): BelongsTo
    {
        return $this->belongsTo(RegulatorRule::class);
    }
}
