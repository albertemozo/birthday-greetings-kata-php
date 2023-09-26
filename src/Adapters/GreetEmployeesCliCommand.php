<?php

namespace BirthdayGreetingsKata\Adapters;

use BirthdayGreetingsKata\Application\BirthdayService;
use BirthdayGreetingsKata\Application\XDate;

class GreetEmployeesCliCommand
{
    public function __invoke(): void
    {
        $birthdayService = new BirthdayService(
            new CsvEmployeesRepository(''),
            new EmailGreeter('','')
        );

        $birthdayService->sendGreetings(new XDate(''));
    }

}