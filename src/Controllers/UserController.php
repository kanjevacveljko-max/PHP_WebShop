<?php

namespace webshop\Controllers;
require_once "vendor/autoload.php";

use webshop\Models\User;
use webshop\Services\SessionService;
use webshop\Services\InputService;

class UserController extends SessionService {

    public function login(array $data):void
    {
        $inputService = new InputService();
        $requiredFields = ['username', 'password'];
        $errors = $inputService::validateRequired($data, $requiredFields);

        if (count($errors) > 0) {
            $this->setSession('errors', $errors);
            header("Location: src/views/users/login.php");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserByUsername($data["username"]);

        if(!password_verify($data["password"], $user["password"])) {
            die("Pogresna lozinka!");
        }

        $this->setSession("user_id", $user["id"])
             ->setSession("logged_in", true)
             ->setSession("role", $user["role"])
             ->setSession("fullName", $user["full_name"]);

        if($this->getFromSession("zapocetaKupovina") === true) {
            header("Location: index.php?action=productPage&id=".$this->getFromSession("productId"));
            exit;
        }
        else{
            if ($user['role'] == 'admin') {
                header("Location: src/Views/Admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
        }


        if($this->getFromSession("zapocetaKupovina") === true) {
            header("Location: index.php?action=product&id=".$this->getFromSession("productId"));
        }
    }


    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: index.php");
    }

    public function register(array $data)
    {
        $inputService = new InputService();
        $requiredFields = ['username','email', 'password', 'confirm_password', 'address', 'phone'];
        $errors = $inputService::validateRequired($data, $requiredFields);

        if ($msg = $inputService::validatePasswordMatch($data['password'], $data['confirm_password'])) {
            $errors[] = $msg;
        }

        if ($msg = $inputService::validateEmail($data['email'])) {
            $errors[] = $msg;
        }

        if (!empty($errors)) {
            $this->setSession('errors', $errors);
            header("Location: src/views/users/register.php");
            exit;
        }

        $userModel = new User();

        if($userModel->userExists($data["username"])) {
            die("Ovaj korisnik vec postoji!");
        }

        $username = $data["username"];
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $address = $data["address"];
        $phone = $data["phone"];
        $email = $data["email"];
        $fullname = $data["fullname"];

        $userModel->createUser($username, $fullname, $email, $password, $address, $phone);

        header("Location: src/views/users/login.php");

    }


}