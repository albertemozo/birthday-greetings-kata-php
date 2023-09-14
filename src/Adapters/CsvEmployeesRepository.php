<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Adapters;

use BirthdayGreetingsKata\Application\Employee;
use BirthdayGreetingsKata\Application\XDate;

final readonly class CsvEmployeesRepository
{
    private const FIRST_NAME_COLUMN = 1;
    private const LAST_NAME_COLUMN = 0;
    private const BIRTH_DATE_COLUMN = 2;
    private const EMAIL_COLUMN = 3;

    public function __construct(private string $fileName)
    {
    }

    public function onBirthday(XDate $xDate): array
    {
        $fileHandler = fopen($this->fileName, 'rb');
        fgetcsv($fileHandler);

        $employees = [];

        while ($employeeData = fgetcsv($fileHandler, null, ',')) {
            $employeeData = array_map('trim', $employeeData);
            $employee = new Employee(
                $employeeData[self::FIRST_NAME_COLUMN],
                $employeeData[self::LAST_NAME_COLUMN],
                $employeeData[self::BIRTH_DATE_COLUMN],
                $employeeData[self::EMAIL_COLUMN]
            );
            if ($employee->isBirthday($xDate)) {
                $employees[] = $employee;
            }
        }
        return $employees;
    }
}