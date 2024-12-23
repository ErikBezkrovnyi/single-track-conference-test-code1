<?php

declare(strict_types=1);

namespace ConferenceApp;

class SpeakerView
{
    /**
     * @var Speaker
     */
    private $speaker;

    /**
     * @param Speaker $speaker
     */
    public function __construct(Speaker $speaker)
    {
        $this->speaker = $speaker;
    }

    /**
     * Make initials from a word with no spaces
     *
     * @param string $name
     * @return string
     */
    protected function makeInitialsFromSingleWord(string $name) : string
    {
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return mb_substr(implode('', $capitals[1]), 0, 1, 'UTF-8');
        }
        return mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8'), 'UTF-8');
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {

        $name = $this->speaker->getName();
        $words = explode(' ', $name);
        if (count($words) == 2) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8') .
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        } elseif (count($words) > 2) {
            return mb_strtoupper(
                mb_substr($words[0], 0, 1, 'UTF-8') .
                mb_substr($words[1], 0, 1, 'UTF-8') .
                mb_substr(end($words), 0, 1, 'UTF-8'),
                'UTF-8');
        }
        return $this->makeInitialsFromSingleWord($name);
    }

    /**
     * @return string
     */
    public function getUppercase(): string
    {

        $name = $this->speaker->getName();
        return mb_strtoupper($name, "UTF-8");
    }
}
