<?php

declare(strict_types=1);

namespace ConferenceApp;

class Presentation extends Slot
{
    public function getStartTime(): \DateTime
    {
        return $this->getStartAt();
    }

    public function getEndTime(): \DateTime
    {
        return $this->getEndAt();
    }
}
