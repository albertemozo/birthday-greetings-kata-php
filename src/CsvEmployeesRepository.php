<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata;

final class CsvEmployeesRepository
{
    private string|null $fileName;

    public function __construct(string|null $fileName = null)
    {
        if ($fileName !== null) {
            $this->fileName = $fileName;
        }
    }

    public function employeesOnBirthday(XDate $xDate): array
    {
        $fileHandler = fopen($this->fileName, 'rb');
        fgetcsv($fileHandler);

        $employees = [];

        while ($employeeData = fgetcsv($fileHandler, null, ',')) {
            $employeeData = array_map('trim', $employeeData);
            $employee = new Employee($employeeData[1], $employeeData[0], $employeeData[2], $employeeData[3]);
            if ($employee->isBirthday($xDate)) {
                $employees[] = $employee;
            }
        }
        return $employees;
    }
}