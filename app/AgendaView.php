<?php

declare(strict_types=1);

namespace ConferenceApp;

class AgendaView
{
    /**
     * @var Agenda
     */
    private $agenda;

    /**
     * @param Agenda $agenda
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * @return int
     */
    public function getNumberOfSlots(): int
    {
        return $this->agenda->count();
    }

    /**
     * return int
     */
    public function getDurationInMinutes(): int
    {
        $totalDuration = 0;
        $previousEndTime = null;

        foreach ($this->agenda as $slot) {
            // Додаємо тривалість поточного слоту
            $totalDuration += $slot->getDuration();

            // Якщо є попередній слот, додаємо тривалість перерви між слотами
            if ($previousEndTime !== null) {
                $breakDuration = (int)(($slot->getStartTime()->getTimestamp() - $previousEndTime->getTimestamp()) / 60);
                $totalDuration += $breakDuration;
            }

            // Оновлюємо час завершення для наступної ітерації
            $previousEndTime = $slot->getEndTime();
        }

        return $totalDuration;
    }

}
