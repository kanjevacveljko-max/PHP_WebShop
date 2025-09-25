<?php

namespace webshop\Models;

class Category extends Db{

    public function getCategoryNameById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $category = $stmt->fetch();
        if ($category &&!empty($category["name"])) {
            return $category["name"];
        }
    }

}