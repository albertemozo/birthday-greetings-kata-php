<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

use BirthdayGreetingsKata\Adapters\EmailGreeter;

final readonly class BirthdayService
{
    private EmailGreeter $greeter;

    public function __construct(private EmployeesRepository $employeesRepository)
    {
    }

    public function sendGreetings(XDate $xDate, string $smtpHost, int $smtpPort): void
    {
        $employees = $this->employeesRepository->onBirthday($xDate);

        $this->greeter = new EmailGreeter($smtpHost, $smtpPort);

        foreach ($employees as $employee) {
            $this->greeter->greet($employee, $smtpHost, $smtpPort);
        }
    }
}
