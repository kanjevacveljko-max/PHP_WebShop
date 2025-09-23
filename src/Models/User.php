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

    public function createUser(string $username, string $password): void
    {
        $stmt = $this->connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }
}