<?php

class Employee
{
    private PDO $conn;
    private string $table = 'employees';

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function getAll(string $search = '', int $limit = 10, int $offset = 0): array
    {
        if ($search !== '') {
            $sql = "
                SELECT * FROM {$this->table}
                WHERE first_name LIKE :search
                OR last_name LIKE :search
                OR email LIKE :search
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset
            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $sql = "
            SELECT * FROM {$this->table}
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll(string $search = ''): int
    {
        if ($search !== '') {
            $sql = "
                SELECT COUNT(*) as total FROM {$this->table}
                WHERE first_name LIKE :search
                OR last_name LIKE :search
                OR email LIKE :search
            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'search' => '%' . $search . '%'
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)$result['total'];
        }

        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'];
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

    public function find(int $id): array|false
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE {$this->table}
            SET 
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone,
                position = :position,
                salary = :salary
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'salary' => $data['salary'],
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function emailExists(string $email): bool
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function emailExistsExceptId(string $email, int $id): bool
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email AND id != :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
}