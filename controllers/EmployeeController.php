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
        $search = trim($_GET['search'] ?? '');

        $page = (int)($_GET['page'] ?? 1);

        if ($page < 1) {
            $page = 1;
        }

        $perPage = 10;

        $totalRecords = $this->employee->countAll($search);

        $totalPages = (int)ceil($totalRecords / $perPage);

        if ($totalPages < 1) {
            $totalPages = 1;
        }

        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;

        $employees = $this->employee->getAll($search, $perPage, $offset);

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

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        $employee = $this->employee->find($id);

        if (!$employee) {
            die('Employee tapılmadı');
        }

        require '../views/employees/edit.php';
    }

    public function update(): void
    {
        $id = (int)($_POST['id'] ?? 0);

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

        $employee = [
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'position' => $position,
            'salary' => $salary,
        ];

        if (!empty($errors)) {
            require '../views/employees/edit.php';
            return;
        }

        $this->employee->update($id, $employee);

        header('Location: index.php');
        exit;
    }

    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            die('Yanlış ID');
        }

        $this->employee->delete($id);

        header('Location: index.php');
        exit;
    }
}