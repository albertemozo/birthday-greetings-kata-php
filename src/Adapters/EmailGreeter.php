<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Adapters;

use BirthdayGreetingsKata\Application\Employee;
use BirthdayGreetingsKata\Application\Greeter;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

final class EmailGreeter implements Greeter
{
    public function __construct(private string $smtpHost, private int $smtpPort)
    {
    }

    public function greet(Employee $employee): void
    {
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