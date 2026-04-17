<?php

class Employee
{
    private PDO $conn;
    private string $table = 'employees';

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO {$this->table}
            (first_name, last_name, email, phone, position, salary)
            VALUES
            (:first_name, :last_name, :email, :phone, :position, :salary)
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'salary' => $data['salary'],
        ]);
    }
}