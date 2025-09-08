<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementRuleLog extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getCpm(): float
    {
        return $this->cpm;
    }

    public function setCpm(float $cpm): self
    {
        $this->cpm = $cpm;

        return $this;
    }

    public function getBudget(): float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

}
