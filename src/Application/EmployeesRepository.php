<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

interface EmployeesRepository
{
    public function onBirthday(XDate $xDate): array;
}