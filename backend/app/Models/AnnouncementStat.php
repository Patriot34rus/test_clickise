<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnouncementStat extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 0;
    public const STATUS_NOT_ACTIVE = 1;

    public function getId(): int
    {
        return $this->id;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getSpent(): int
    {
        return (int) $this->spent;
    }

    public function setSpent(int $spent): self
    {
        $this->spent = $spent;

        return $this;
    }

    public function getClicks(): int
    {
        return (int) $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getStatus(): int
    {
        return (int) $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateTime(): \DateTimeImmutable
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

}
