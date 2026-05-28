<?php

class Validator {

    // Returns error array if any field is missing, null if all present
    public static function requireFields(array $data, array $fields) {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || $data[$field] === '' || $data[$field] === null)
                return ['success' => false, 'message' => "Missing required field: $field"];
        }
        return null;
    }

    public static function isEmail(string $value): bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function isPositiveInt($value): bool {
        return filter_var($value, FILTER_VALIDATE_INT) !== false && (int)$value > 0;
    }

    public static function sanitize(string $value): string {
        return strip_tags(trim($value));
    }
}
