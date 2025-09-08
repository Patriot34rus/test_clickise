<?php
declare(strict_types=1);

namespace App\Models;

use App\Regulator\Enum\RuleActionEnum;
use App\Regulator\Enum\RuleParametersEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegulatorAction extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->action_type;
    }

    public function setType(RuleActionEnum $type): self
    {
        $this->action_type = $type->value;

        return $this;
    }

    public function getParameter(): string
    {
        return $this->parameter;
    }

    public function setParameter(RuleParametersEnum $parameter): self
    {
        $this->parameter = $parameter->value;

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

    public function getRule(): BelongsTo
    {
        return $this->belongsTo(RegulatorRule::class);
    }
}
