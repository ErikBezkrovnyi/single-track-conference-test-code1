<?php

declare(strict_types=1);

namespace Base;

use ConferenceApp\{Presentation, SlotView, Speaker};
use PHPUnit\Framework\TestCase;

class SlotViewTest extends TestCase
{
    /**
     * @dataProvider getSlotDates
     * @param \DateTime $startAt
     * @param \DateTime $endAt
     * @param int $durationInMinutes
     */
    public function testDurationInMinutes(\DateTime $startAt, \DateTime $endAt, int $durationInMinutes): void
    {
        $slot = new Presentation(
            new Speaker('Johny'),
            'title',
            'description',
            $startAt,
            $endAt
        );
        $view = new SlotView($slot);

        $this->assertEquals($durationInMinutes, $view->getDurationInMinutes());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getSlotDates(): array
    {
        return [
            [new \DateTime('2000-01-01 00:00:00'), new \DateTime('2000-01-01 00:00:01'), 1],
            [new \DateTime('2000-01-01 00:00:00'), new \DateTime('2000-01-01 00:59:00'), 59],
            [new \DateTime('2000-01-01 00:00:00'), new \DateTime('2000-01-01 01:59:00'), 60 + 59],
        ];
    }

    /**
     * @dataProvider getSlotDescriptionExcerpts
     * @param string $description
     * @param int $length
     * @param string $excerpt
     * @throws \Exception
     */
    public function testDescriptionExcerpts(string $description, int $length, string $excerpt): void
    {
        $slot = new Presentation(
            new Speaker('Johny'),
            'title',
            $description,
            new \DateTime('2000-01-01 00:00:00'),
            new \DateTime('2000-01-01 00:59:00')
        );
        $view = new SlotView($slot);

        $this->assertEquals($excerpt, $view->getDescriptionExcerpt($length));
    }

    /**
     * @return array
     */
    public function getSlotDescriptionExcerpts(): array
    {
        return [
            ['lorem ipsum dolor sit amet', 0, ''],
            ['<p>lorem ipsum dolor sit amet</p>', 5, 'lorem'],
            ['zażółć gęslą jaźń żółwia', 12, 'zażółć gęslą'],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @throws \Exception
     */
    public function testExcerptInvalidArguments(): void
    {
        $slot = new Presentation(
            new Speaker('Johny'),
            'title',
            'description',
            new \DateTime('2000-01-01 00:00:00'),
            new \DateTime('2000-01-01 00:59:00')
        );
        $view = new SlotView($slot);

        $this->expectException(\InvalidArgumentException::class);
        $view->getDescriptionExcerpt(-2);
    }

}
