<?php

declare(strict_types=1);

namespace Base;

use ConferenceApp\{Agenda, Presentation, Speaker, Workshop};
use PHPUnit\Framework\TestCase;

class AgendaTest extends TestCase
{
    public function testAddValidSlot(): void
    {
        $agenda = new Agenda();
        $presentation = new Presentation(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 00:00:00'),
            new \DateTime('2000-01-01 00:59:00')
        );

        $this->assertFalse($agenda->overlaps($presentation));

        $agenda->addSlot($presentation);

        $this->assertTrue($agenda->overlaps($presentation));
    }

    public function testAddOverlappingSlots(): void
    {
        $agenda = new Agenda();
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
            new \DateTime('2000-01-01 00:30:00'),
            new \DateTime('2000-01-01 01:59:00')
        );

        $this->assertFalse($agenda->overlaps($presentation));
        $this->assertFalse($agenda->overlaps($workshop));

        $agenda->addSlot($presentation);

        $this->assertTrue($agenda->overlaps($presentation));
        $this->assertTrue($agenda->overlaps($workshop));
    }
}
