<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Adapters;

use BirthdayGreetingsKata\Application\Employee;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

final class EmailGreeter
{
    public function __construct(private string|null $smtpHost = null, private int|null $smtpPort = null)
    {
    }

    public function greet(Employee $employee, string $smtpHost, int $smtpPort): void
    {
        $this->smtpPort = $smtpPort;
        $this->smtpHost = $smtpHost;

        $mailer = new Mailer(
            Transport::fromDsn('smtp://' . $this->smtpHost . ':' . $this->smtpPort)
        );

        $message = (new Email())
            ->subject('Happy Birthday!')
            ->from('sender@here.com')
            ->to($employee->getEmail())
            ->text(sprintf('Happy Birthday, dear %s!', $employee->getFirstName()));

        $mailer->send($message);
    }
}