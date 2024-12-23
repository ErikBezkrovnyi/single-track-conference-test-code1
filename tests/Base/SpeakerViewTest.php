<?php

declare(strict_types=1);

namespace Bases;

use ConferenceApp\{Speaker,SpeakerView};
use PHPUnit\Framework\TestCase;

class SpeakerViewTest extends TestCase
{
    /**
     * @dataProvider getSpeakerData
     * @param string $name
     * @param string $nameInitials
     * @param string $nameUppercase
     */
    public function testInitialGeneration(string $name, string $nameInitials, string $nameUppercase): void
    {
        $speaker = new Speaker($name);
        $view = new SpeakerView($speaker);


        $this->assertEquals($name, $speaker->getName());
        $this->assertEquals($nameInitials, $view->getInitials());
        $this->assertEquals($nameUppercase, $view->getUppercase());
    }

    /**
     * @return array
     */
    public function getSpeakerData(): array
    {
        return [
            ['Łukasz', 'Ł', 'ŁUKASZ'],
            ['Łukasz Żółwiński', 'ŁŻ', 'ŁUKASZ ŻÓŁWIŃSKI'],
            ['Łukasz Tomasz Żółwiński', 'ŁTŻ', 'ŁUKASZ TOMASZ ŻÓŁWIŃSKI'],
        ];
    }
}
