# Employee Management Mini System

This project is a simple Employee Management Mini System built with Core PHP and MySQL.

## Features

- Add new employee
- List employees
- Edit employee
- Delete employee with confirmation
- Search employees by name or email
- Pagination - 10 records per page
- Input validation
- SQL Injection protection with PDO prepared statements
- XSS protection with htmlspecialchars

## Technologies Used

- Core PHP
- MySQL
- PDO
- HTML

## Project Structure

```txt
employee-management/
│
├── config/
│   └── database.php
│
├── controllers/
│   └── EmployeeController.php
│
├── models/
│   └── Employee.php
│
├── views/
│   └── employees/
│       ├── index.php
│       ├── create.php
│       └── edit.php
│
├── public/
│   └── index.php
│
├── database.sql
└── README.md

```

## Database Setup

1. Open phpMyAdmin.

2. Create a new database:

```sql
employee_management
```

3. Import the `database.sql` file into phpMyAdmin.

Or run this SQL manually:

```sql
CREATE DATABASE IF NOT EXISTS employee_management 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE employee_management;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Installation

1. Clone the repository:

```bash
git clone https://github.com/UlviAlili/employee-management-core-php.git
```

2. Move the project to WAMP `www` folder:

```txt
C:\wamp64\www\employee-management
```

3. Start WAMP server.

4. Open the project in browser:

```txt
http://localhost/employee-management/public/index.php
```

## Database Configuration

Database connection file:

```txt
config/database.php
```

Default WAMP configuration:

```php
private string $host = 'localhost';
private string $db_name = 'employee_management';
private string $username = 'root';
private string $password = '';
```

## Usage

### Employee List

```txt
http://localhost/employee-management/public/index.php
```

### Add Employee

```txt
http://localhost/employee-management/public/index.php?action=create
```

### Edit Employee

Click the `Edit` link from the employee list.

### Delete Employee

Click the `Delete` link from the employee list and confirm the delete action.

### Search

Use the search input on the employee list page to search employees by name or email.

## Validation Rules

- First name is required
- Last name is required
- Email is required
- Email must be valid
- Email must be unique
- Phone is required
- Position is required
- Salary is required
- Salary must be numeric

## Security

- PDO prepared statements are used to prevent SQL Injection.
- `htmlspecialchars()` is used when displaying data to prevent XSS.
- User input is validated before insert and update operations.

## Author

Ulvi Alili