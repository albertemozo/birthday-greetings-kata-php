<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

final readonly class BirthdayService
{
    public function __construct(
        private EmployeesRepository $employeesRepository,
        private Greeter $greeter
    )
    {
    }

    public function sendGreetings(XDate $xDate): void
    {
        $employees = $this->employeesRepository->onBirthday($xDate);

        foreach ($employees as $employee) {
            $this->greeter->greet($employee);
        }
    }
}
