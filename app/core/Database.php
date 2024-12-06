<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;

    private function __construct() {
        // Private to prevent from external instantiation.
    }

    public static function getInstance() {
        if (!self::$instance) {
            try {
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                self::$instance = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS,$options);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection error: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
