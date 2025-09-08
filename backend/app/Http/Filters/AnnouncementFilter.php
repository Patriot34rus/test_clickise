<?php
declare(strict_types=1);

namespace App\Http\Filters;

class AnnouncementFilter
{
    public function __construct(
        readonly private int $page = 0,
        readonly private ?int $limit = 10,
        readonly private ?\DateTimeImmutable $startDate = null,
        readonly private ?\DateTimeImmutable $endDate = null,
        readonly private ?int $announcement = null
    ) {
    }

    public
    function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public
    function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public
    function getAnnouncement(): ?int
    {
        return $this->announcement;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getOffset(): int
    {
        return $this->limit * ($this->page - 1);
    }
}
