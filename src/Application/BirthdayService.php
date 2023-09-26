<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

use BirthdayGreetingsKata\Adapters\EmailGreeter;

final readonly class BirthdayService
{
    public function __construct(
        private EmployeesRepository $employeesRepository,
        private EmailGreeter $greeter
    )
    {
    }

    public function sendGreetings(XDate $xDate, string $smtpHost, int $smtpPort): void
    {
        $employees = $this->employeesRepository->onBirthday($xDate);

        foreach ($employees as $employee) {
            $this->greeter->greet($employee);
        }
    }
}
