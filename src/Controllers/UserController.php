<?php

namespace webshop\Controllers;
require_once "vendor/autoload.php";

use webshop\Models\User;
use webshop\Services\SessionService;

class UserController extends SessionService {

    private function checkInput(array $requiredFields, array $data)
    {
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($data[$field]) || !isset($data[$field])) {
                $errors[] = ucfirst($field) . " is required";
            }
        }
        if (!empty($errors)) {
            $this->setSession('errors', $errors);
            header("Location: src/views/users/register.php");
            exit;
        }
    }

    public function login(array $data):void
    {
        $requiredFields = ['username', 'password'];
        $this->checkInput($requiredFields, $data);

        $userModel = new User();
        $user = $userModel->getUserByUsername($data["username"]);

        if(!password_verify($data["password"], $user["password"])) {
            die("Pogresna lozinka!");
        }

        $this->setSession("user_id", $user["id"])
             ->setSession("logged_in", true)
             ->setSession("role", $user["role"]);
    }

    public function register(array $data)
    {
        $requiredFields = ['username','email', 'password', 'confirm_password', 'address', 'phone'];
        $this->checkInput($requiredFields, $data);

        $userModel = new User();

        if($userModel->userExists($data["username"])) {
            die("Ovaj korisnik vec postoji!");
        }

        if($data["password"] !== $data["confirm_password"]){
            die("Sifre se ne poklapaju!");
        }

        $username = $data["username"];
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $address = $data["address"];
        $phone = $data["phone"];
        $email = $data["email"];
        $fullname = $data["fullname"];

        $userModel->createUser($username, $fullname, $email, $password, $address, $phone);

    }


}