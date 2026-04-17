<?php

class EmployeeController
{
    private Employee $employee;

    public function __construct(PDO $db)
    {
        $this->employee = new Employee($db);
    }

    public function index(): void
    {
        $employees = $this->employee->getAll();

        require '../views/employees/index.php';
    }
}