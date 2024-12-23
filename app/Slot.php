<?php

declare(strict_types=1);

namespace ConferenceApp;

abstract class Slot
{
    /**
     * @var Speaker
     */
    private Speaker $speaker;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var \DateTime
     */
    private \DateTime $startAt;

    /**
     * @var \DateTime
     */
    private \DateTime $endAt;

    /**
     * @param Speaker $speaker
     * @param string $title
     * @param string $description
     * @param \DateTime $startAt
     * @param \DateTime $endAt
     */
    public function __construct(
        Speaker $speaker,
        string $title,
        string $description,
        \DateTime $startAt,
        \DateTime $endAt
    ) {
        if ($startAt >= $endAt) {
            throw new \InvalidArgumentException('End time must be after start time.');
        }

        $this->speaker = $speaker;
        $this->title = $title;
        $this->description = $description;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    /**
     * Обчислює тривалість слота в хвилинах.
     *
     * @return int
     */
    public function getDuration(): int
    {
        return (int)(($this->endAt->getTimestamp() - $this->startAt->getTimestamp()) / 60);
    }

    /**
     * Перевіряє, чи перетинається поточний слот із переданим.
     *
     * @param Slot $slot
     * @return bool
     */
    public function overlaps(Slot $slot): bool
    {
        return ($this->startAt < $slot->getEndAt() && $this->endAt > $slot->getStartAt());
    }

    /**
     * @return \DateTime
     */
    public function getStartAt(): \DateTime
    {
        return $this->startAt;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt(): \DateTime
    {
        return $this->endAt;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
