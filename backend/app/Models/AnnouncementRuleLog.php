<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnouncementRuleLog extends Model
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getCpm(): float
    {
        return (float) $this->cpm;
    }

    public function setCpm(float $cpm): self
    {
        $this->cpm = $cpm;

        return $this;
    }

    public function getBudget(): float
    {
        return (float) $this->budget;
    }

    public function setBudget(float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateTime(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function getAnnouncement(): Announcement
    {
        return $this->announcement()->first();
    }

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }

    public function getRule(): RegulatorRule
    {
        return $this->rule()->first();
    }

    public function rule(): belongsTo
    {
        return $this->belongsTo(RegulatorRule::class, 'rule_id');
    }
}
