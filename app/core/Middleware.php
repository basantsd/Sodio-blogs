<?php
namespace App\Core;

class Middleware {
    public static function isUserAuthenticated() {
        if (!SessionManager::isUserAuthenticated()) {
            header('Location: '.APP_URL.'/login');
            exit;
        }else{
            return 1;
        }
    }

    public static function isAdminAuthenticated() {
        if (!SessionManager::isAdminAuthenticated()) {
            header('Location: '.APP_URL.'/admin/login');
            exit;
        }else{
            return 1;
        }
    }
}
