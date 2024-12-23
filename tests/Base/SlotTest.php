<?php

declare(strict_types=1);

namespace Base;

use ConferenceApp\{Presentation, Speaker};
use PHPUnit\Framework\TestCase;

class SlotTest extends TestCase
{
    /**
     * @dataProvider getSlotInvalidParameters
     * @expectedException \InvalidArgumentException
     * @param string $title
     * @param string $description
     * @param \DateTime $startAt
     * @param \DateTime $endAt
     */
    public function testInvalidArguments(string $title, string $description, \DateTime $startAt, \DateTime $endAt): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Presentation(
            new Speaker('Johny'),
            $title,
            $description,
            $startAt,
            $endAt
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSlotInvalidParameters(): array
    {
        return [
            // Start date is later than end date
            ['title', 'description', new \DateTime('2000-01-01 00:59:00'), new \DateTime('2000-01-01 00:00:00')],
            // Start date is the same as end date
            ['title', 'description', new \DateTime('2000-01-01 00:00:00'), new \DateTime('2000-01-01 00:00:00')],
        ];
    }
}
