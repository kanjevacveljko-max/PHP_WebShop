<?php

namespace webshop\Models;

require_once "vendor/autoload.php";

class User extends Db {

    public function userExists(string $username): bool
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :name");
        $stmt->bindParam(":name", $username);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function getUserByUsername(string $username): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :name");
        $stmt->bindParam(":name", $username);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function createUser(string $username, string $fullName, string $email, string $password, string $address, string $phone): void
    {
        $stmt = $this->connection->prepare("INSERT INTO users (username, full_name, password, email, address, phone) 
                                                  VALUES (:username, :fullname, :password, :email, :address, :phone)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":fullname", $fullName);

        $stmt->execute();
    }
}