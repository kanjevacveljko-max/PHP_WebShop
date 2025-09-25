<?php

namespace webshop\Models;
class Image extends Db {

    public function uploadIntoDatabase(string $productId, string $imageUrl): void
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO images (product_id, image_path) 
                   VALUES (:product_id, :image_url)");
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':image_url', $imageUrl);
        $stmt->execute();

        header("Location: index.php?action=allProducts");
    }

    public function existsImageForProduct($productId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM images WHERE product_id = :productId");
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function getImageUrl(int $productId)
    {
        $stmt = $this->connection->prepare("SELECT image_path FROM images WHERE product_id = :productId");
        $stmt->bindParam(":productId", $productId);
        $stmt->execute();

        $imagePath = $stmt->fetch();

        if ($imagePath && !empty($imagePath['image_path'])) {
            return $imagePath['image_path'];
        }
    }

}