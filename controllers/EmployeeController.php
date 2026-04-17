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

    public function create(): void
    {
        require '../views/employees/create.php';
    }

    public function store(): void
    {
        $errors = [];

        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $salary = trim($_POST['salary'] ?? '');

        if ($first_name === '') {
            $errors['first_name'] = 'Ad boş ola bilməz';
        }

        if ($last_name === '') {
            $errors['last_name'] = 'Soyad boş ola bilməz';
        }

        if ($email === '') {
            $errors['email'] = 'Email boş ola bilməz';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email düzgün deyil';
        }

        if ($phone === '') {
            $errors['phone'] = 'Telefon boş ola bilməz';
        }

        if ($position === '') {
            $errors['position'] = 'Vəzifə boş ola bilməz';
        }

        if ($salary === '') {
            $errors['salary'] = 'Maaş boş ola bilməz';
        } elseif (!is_numeric($salary)) {
            $errors['salary'] = 'Maaş rəqəm olmalıdır';
        }

        if (!empty($errors)) {
            require '../views/employees/create.php';
            return;
        }

        $this->employee->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'position' => $position,
            'salary' => $salary,
        ]);

        header('Location: index.php');
        exit;
    }
}