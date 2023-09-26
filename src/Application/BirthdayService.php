<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

use BirthdayGreetingsKata\Adapters\EmailGreeter;

final class BirthdayService
{
    public function __construct(
        private readonly EmployeesRepository $employeesRepository,
        private ?EmailGreeter $greeter = null
    )
    {
    }

    public function sendGreetings(XDate $xDate, string $smtpHost, int $smtpPort): void
    {
        $employees = $this->employeesRepository->onBirthday($xDate);

        if ($this->greeter === null) {
            $this->greeter = new EmailGreeter($smtpHost, $smtpPort);
        }

        foreach ($employees as $employee) {
            $this->greeter->greet($employee);
        }
    }
}
