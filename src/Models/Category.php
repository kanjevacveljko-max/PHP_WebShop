<?php

namespace webshop\Models;

class Category extends Db{

    public function getCategoryNameById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `categories` WHERE `id` = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch()['name'];
    }
}