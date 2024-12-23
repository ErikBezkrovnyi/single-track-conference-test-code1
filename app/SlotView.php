<?php

declare(strict_types=1);

namespace ConferenceApp;

class SlotView
{
    /**
     * @var Slot
     */
    private $slot;

    /**
     * @param Slot $slot
     */
    public function __construct(Slot $slot)
    {
        $this->slot = $slot;
    }

    /**
     * @return int
     */
    public function getDurationInMinutes(): int
    {
        /**
         * @todo: Implement it
         */
        $startAt = $this->slot->getStartAt();
        $endAt = $this->slot->getEndAt();
        $difference = date_diff($startAt, $endAt);

        $minutes = $difference->days * 24 * 60;
        $minutes += $difference->h * 60;
        $minutes += $difference->i;

        if ($minutes == 0){
            $minutes = $endAt->getTimestamp() - $startAt->getTimestamp();
        }
        return $minutes;
    }

    /**
     * @param $length int
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getDescriptionExcerpt(int $length = 10): string
    {

        $text = $this->slot->getDescription();
        $str_len = strlen($text);
        $text = strip_tags($text);

        if($length < 0) {
            throw new \InvalidArgumentException();
        } elseif ($str_len > $length) {
            $text = mb_substr($text, 0, $length,'UTF-8');
        }
        return $text;

        //return wordwrap(mb_substr(strip_tags($text), 0, $length,'UTF-8'));
    }
}
