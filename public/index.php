<?php

require_once '../config/database.php';
require_once '../models/Employee.php';
require_once '../controllers/EmployeeController.php';

$database = new Database();
$db = $database->connect();

$controller = new EmployeeController($db);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'store':
        $controller->store();
        break;

    case 'index':
    default:
        $controller->index();
        break;
}