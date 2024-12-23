<?php

declare(strict_types=1);

namespace Base;

use ConferenceApp\{Agenda, AgendaView, Presentation, Speaker, Workshop};
use PHPUnit\Framework\TestCase;

class AgendaViewTest extends TestCase
{
    /**
     * @dataProvider getSlotsForCountingTest
     * @param $slots
     * @param $numberOfSlots
     */
    public function testCalculateNumberOfSlots($slots, $numberOfSlots): void
    {
        $agenda = new Agenda();

        foreach ($slots as $slot) {
            $agenda->addSlot($slot);
        }

        $view = new AgendaView($agenda);

        $this->assertEquals($numberOfSlots, $view->getNumberOfSlots());
    }

    /**
     * @dataProvider getSlotsForDurationTest
     * @param $slots
     * @param $durationInMinutes
     */
    public function testCalculateAgendaDuration($slots, $durationInMinutes): void
    {
        $agenda = new Agenda();

        foreach ($slots as $slot) {
            $agenda->addSlot($slot);
        }

        $view = new AgendaView($agenda);

        $this->assertEquals($durationInMinutes, $view->getDurationInMinutes());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSlotsForCountingTest(): array
    {
        $presentation = new Presentation(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 00:00:00'),
            new \DateTime('2000-01-01 00:59:00')
        );

        $workshop = new Workshop(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 02:00:00'),
            new \DateTime('2000-01-01 02:59:00')
        );

        return [
            [[], 0],
            [[$presentation], 1],
            [[$presentation, $presentation], 1],
            [[$presentation, $workshop], 2],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getSlotsForDurationTest(): array
    {
        $presentation = new Presentation(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 00:00:00'),
            new \DateTime('2000-01-01 00:59:00')
        );

        $workshop = new Workshop(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 02:00:00'),
            new \DateTime('2000-01-01 02:59:00')
        );

        return [
            [[], 0],
            [[$presentation], 59],
            [[$presentation, $presentation], 59],
            [[$presentation, $workshop], 60 + 60 + 59],
            // Test if slots are sorted in the iterator
            [[$workshop, $presentation], 60 + 60 + 59],
        ];
    }
}
