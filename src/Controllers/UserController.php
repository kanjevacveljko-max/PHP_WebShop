<?php

namespace webshop\Controllers;
require_once "vendor/autoload.php";

use webshop\Models\User;
use webshop\Services\SessionService;

class UserController extends SessionService {

    public function login(array $data)
    {
        if (!isset($data["username"]) || empty($data["username"])) {
            die("Niste prosledili username!");
        }

        if (!isset($data["password"]) || empty($data["password"])) {
            die("Niste prosledili password!");
        }

        $userModel = new User();
        if (!$userModel->userExists($data["username"])) {
            die("Korisnik sa ovim korisnickim imenom ne postoji u bazi podataka!");
        }

        $user = $userModel->getUserByUsername($data["username"]);

        if(!password_verify($data["password"], $user["password"])) {
            die("Pogresna lozinka!");
        }

        $this->setSession("user_id", $user["id"])
             ->setSession("logged_in", true)
             ->setSession("role", $user["role"]);
    }


}