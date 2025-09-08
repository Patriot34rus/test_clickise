<?php
declare(strict_types=1);

namespace App\Regulator\Dto;

use App\Models\Announcement;

class ActionDto
{
    public function __construct(
        readonly private Announcement $announcement,
        readonly private string $actionType,
        readonly private string $parameter,
        readonly private int|float $value
    ) {
    }

    public function getActionType(): string
    {
        return $this->actionType;
    }

    public function getParameter(): string
    {
        return $this->parameter;
    }

    public function getValue(): float|int
    {
        return $this->value;
    }

    public function getAnnouncement(): Announcement
    {
        return $this->announcement;
    }
}
