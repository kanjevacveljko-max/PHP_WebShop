<?php

namespace webshop\Controllers;
use webshop\Models\Product;
use webshop\Services\SessionService;
use webshop\Services\UploadService;

class AdminController extends SessionService {

    public function addNewProduct($data) {

        $uploadService = new UploadService();
        $image = $data["image"];

        $imageSize = $image['size'];
        if(!$uploadService->isValidSize($imageSize)){
            $_SESSION["imageErrors"][] = "Slika je prevelika";
        }

        $tmpName = $image["tmp_name"];
        list($width, $height) = getimagesize($tmpName);
        if(!$uploadService->isValidProportions($width, $height)){
            $this->setSession("imageErrors","Format slike nije dobar!");
            $_SESSION["imageErrors"][] = "Slika je presiroka ili previsoka!";
        }

        $imgName = $image['name'];
        $imageType = pathinfo($imgName, PATHINFO_EXTENSION);
        if(!$uploadService->isValidExtension($imageType)) {
            $this->setSession("imageErrors","Format slike nije dobar!");
        }

        $randomName = $uploadService->generateRandomName('jpg');

        if(!is_dir("./uploads")){
            mkdir("./uploads", 0755, true);
        }

        $uploadService->upload($tmpName, $randomName, "../../uploads/$randomName");

        $productModel = new Product();
        $productModel->createProduct();

        //in$categoryId, string $name, string $description, string $brand, int $price, int $stock, string $image

        $categoryId = $data["category"];
        $name = $data["name"];
        $description = $data["description"];
        $brand = $data["brand"];
        $price = $data["price"];
        $stock = $data["stock"];
        $image = $randomName;

        $productModel = new Product();
        $productModel->createProduct($categoryId, $name, $description, $brand, $price, $stock, $image);
    }

}