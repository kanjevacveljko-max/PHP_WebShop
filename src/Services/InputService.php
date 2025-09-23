<?php

namespace webshop\Services;
class InputService{

    public static function validateRequired(array $data, array $requiredFields): array
    {
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($data[$field] || !isset($data[$field]))) {
                $errors[] = ucfirst($field) . " je obavezno polje!";
            }
        }
        return $errors;
    }

    public static function validatePasswordMatch(string $password, string $confirmPassword): ?string
    {
            return $password !== $confirmPassword ? "Sifre se ne poklapaju." : null;
    }


    public static function validateEmail(string $email): ?string
    {
        return !filter_var($email, FILTER_VALIDATE_EMAIL) ? "Email nije u dobrom formatu!" : null;
    }
}
