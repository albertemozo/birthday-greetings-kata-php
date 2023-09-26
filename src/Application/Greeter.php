<?php

namespace BirthdayGreetingsKata\Application;

interface Greeter
{
    public function greet(Employee $employee): void;
}