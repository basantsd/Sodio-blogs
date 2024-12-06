<?php
namespace App\Core;

class Validator {
    public static function sanitize($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
