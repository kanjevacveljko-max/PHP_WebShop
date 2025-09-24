<?php

namespace webshop\Controllers;

require_once "vendor/autoload.php";

use webshop\Models\Image;
use webshop\Models\Product;
use webshop\Services\ImageService;
use webshop\Services\SessionService;

class ImageController extends SessionService {
    public function uploadProductImages(array $files, int $productId)
    {
        $imageService = new ImageService();

        foreach ($files['name'] as $key => $file) {
            $name = $files['name'][$key];
            $size = $files['size'][$key];
            $tmp = $files['tmp_name'][$key];

            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!$imageService->isValidExtension($extension)) {
                $this->setSession("errors", "Extension $extension is not allowed");
                exit();
            }

            if (!$imageService->isValidSize($size)) {
                $this->setSession("errors", "Size $size is not allowed");
                exit;
            }

            list($width, $height) = getimagesize($tmp);
            if (!$imageService->isValidProportions($width, $height)) {
                $this->setSession("errors", "Slika prelazi dozvoljene dimenzije.");
                continue;
            }

            // Generiši ime i snimi
            $newName = $imageService->generateRandomName($extension);
            $uploadDir = __DIR__ . '/../../uploads/';
            $targetPath = $uploadDir . $newName;

            if (!move_uploaded_file($tmp, $targetPath)) {
                $this->setSession("errors", "Greška pri snimanju fajla");
                exit;
            }

            $dbPath = "uploads/" . $newName;

            $imageModel = new Image();
            $imageModel->uploadIntoDatabase($productId, $dbPath);
        }
    }
}