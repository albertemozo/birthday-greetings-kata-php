<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

use DateTime;

class XDate
{
    private false|DateTime $date;

    public function __construct(string $yyyyMMdd)
    {
        $this->date = DateTime::createFromFormat('Y/m/d', $yyyyMMdd);
    }

    public function getDay(): int
    {
        return (int) $this->date->format('d');
    }

    public function getMonth(): int
    {
        return (int) $this->date->format('m');
    }

    public function isSameDay(XDate $anotherDate): bool
    {
        return
            $anotherDate->getDay() === $this->getDay()
            && $anotherDate->getMonth() === $this->getMonth()
        ;
    }

    public function equals(mixed $obj): bool
    {
        if (!($obj instanceof self)) {
            return false;
        }

        return $obj->date == $this->date;
    }

    public function __toString(): string
    {
        return $this->date->format('Y/m/d');
    }
}
