<?php

require_once "vendor/autoload.php";

use webshop\Controllers\UserController;
use webshop\Controllers\AdminController;

$action = $_REQUEST['action'] ?? 'home';

switch ($action) {
    case 'login':
        (new UserController())->login($_POST);
        break;
    case 'register':
        (new UserController())->register($_POST);
        break;
    case 'newProduct':
        (new AdminController())->addNewProduct($_POST);
        break;
    default:
        include __DIR__ . '/src/views/home.php';
        break;
}