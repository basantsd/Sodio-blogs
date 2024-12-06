<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $email = Validator::sanitize($_POST['email']);
            $password = Validator::sanitize($_POST['password']);

            $user = $userModel->find(['email'=>$email,'role'=>'user']);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_logged_in'] = true;
                header("Location: ".APP_URL);
                exit;
            } else {
                $_SESSION['error'] = 'Invalid login credentials.';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
        }
        $this->view('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();

            $name = Validator::sanitize($_POST['name']);
            $email = Validator::sanitize($_POST['email']);
            $password = Validator::sanitize($_POST['password']);

            $user = $userModel->find(['email'=>$email,'role'=>'user']);
            if (!$name || $name == '') {
                $_SESSION['error'] = 'Invalid user name';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }else if (!$email || $email == '') {
                $_SESSION['error'] = 'Email address required';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }else if (!$password || $password == '' || strlen($password) < 5) {
                $_SESSION['error'] = 'Invalid password or length should be greater than 5.';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['error'] = 'Invalid email address';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                $haspwd = password_hash($password,PASSWORD_DEFAULT);
                $userModel = new User();
                $existingUser = $userModel->find(['email'=>$email]);
                if($existingUser){
                    $_SESSION['error'] = 'Email already exists.';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                   header('Location: ' . $redirectUrl);
                   exit;
                }
                $userModel->insert([
                    'name' => $name,
                    'email' => $email,
                    'password'=>$haspwd,
                    'status' => 'active'
                ]);
                $_SESSION['message'] = 'Register successfully';
                header('Location: ' . APP_URL . '/admin/users');
                exit;
            }
        }
        $this->view('auth/register');
    }

    public function logout(){
        session_destroy();
        header("Location: ".APP_URL."/login");
        exit;
    }
}
