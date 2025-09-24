<?php

namespace webshop\Services;

class UploadService
{

    const ALLOWED_EXSTENSIONS = ["jpg", "jpeg", "png", "gif"];
    const MAX_FILE_SIZE = 0.05 * 1024 * 1024;
    const MAX_IMAGE_WIDTH = 1920;
    const MAX_IMAGE_HEIGHT = 1024;

    public function upload(string $image, string $finalName, string $destination): void
    {
        $finalDestination = $destination."/".$finalName;
        move_uploaded_file($image, $finalDestination);
    }

    public function isValidProportions(int $width, int $height): bool
    {
        return $width <= self::MAX_IMAGE_WIDTH && $height <= self::MAX_IMAGE_HEIGHT;
    }

    public function isValidExtension(string $extension): bool
    {
        return in_array($extension, self::ALLOWED_EXSTENSIONS);
    }

    public function isValidSize(int $size): bool
    {
        return  $size <= self::MAX_FILE_SIZE;
    }

    public function generateRandomName(string $extension): string
    {
        return uniqid().".".$extension;
    }

}