<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

final readonly class BirthdayService
{
    public function __construct(private EmployeesRepository $employeesRepository)
    {
    }

    public function sendGreetings(XDate $xDate, string $smtpHost, int $smtpPort): void
    {
        $employees = $this->employeesRepository->onBirthday($xDate);

        foreach ($employees as $employee) {
            $this->greet($employee, $smtpHost, $smtpPort);
        }
    }

    private function greet(Employee $employee, string $smtpHost, int $smtpPort): void
    {
        $mailer = new Mailer(
            Transport::fromDsn('smtp://' . $smtpHost . ':' . $smtpPort)
        );

        $message = (new Email())
            ->subject('Happy Birthday!')
            ->from('sender@here.com')
            ->to($employee->getEmail())
            ->text(sprintf('Happy Birthday, dear %s!', $employee->getFirstName()));

        $mailer->send($message);
    }
}
