<?php

namespace BirthdayGreetingsKata\Adapters;

use BirthdayGreetingsKata\Application\Employee;
use BirthdayGreetingsKata\Application\Greeter;

class UselessGreeter implements Greeter
{

    public function greet(Employee $employee): void
    {
        // Do nothing
    }
}