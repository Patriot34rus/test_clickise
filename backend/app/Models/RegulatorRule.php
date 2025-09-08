<?php
declare(strict_types=1);

namespace App\Models;

use App\Regulator\Enum\RuleTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class RegulatorRule extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function setPattern(RuleTypeEnum $pattern): self
    {
        $this->pattern = $pattern->value;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getConditions(): Collection
    {
        return $this->conditions()->get();
    }

    public function getAction(): ?RegulatorAction
    {
        return $this->action()->first();
    }

    public function conditions(): HasMany
    {
        return $this->hasMany(RegulatorCondition::class, 'rule_id');
    }

    public function action(): HasOne
    {
        return $this->hasOne(RegulatorAction::class, 'rule_id');
    }
}
