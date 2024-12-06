<?php

namespace App\Controllers\Admin;
use App\Core\Controller;
use App\Core\SendMail;
use App\Core\Validator;
use App\Models\User;
use DateTime;

class AdminAuthController extends Controller {
    public function index() {
        $postModel = $this->model('Post');
        $posts = $postModel->getPosts();
        $this->view('home', ['posts' => $posts]);
    }


    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $email = Validator::sanitize($_POST['email']);
            $password = Validator::sanitize($_POST['password']);

            $user = $userModel->find(['email'=>$email,'role'=>'admin']);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_logged_in'] = true;
                header("Location: ".APP_URL."/admin/dashboard");
                exit;
            } else {
                $_SESSION['error'] = 'Invalid login credentials.';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
        }
        $this->view('admin/auth/login');
    }

    public function logout(){
        session_destroy();
        header("Location: ".APP_URL."/admin/login");
        exit;
    }


    public function forgot_password(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $userModel = new User();
            $user = $userModel->find(['email'=>$email,'role'=>'admin']);
        
            if ($user) {
                $resetToken = bin2hex(random_bytes(32));
                $expireTime = date('Y-m-d H:i:s', strtotime('+1 hour'));  

                $userModel->update(['id'=>$user['id']],[
                    'reset_token'=> $resetToken, 
                    'reset_token_expires'=>$expireTime
                ]);
        
                $resetLink = APP_URL."/reset-password?token=$resetToken";
                $subject = "Password Reset Request";
                $message = "<p>Please click on the following link to reset your password: <a href='$resetLink'>Reset Password</a></p>";
                $mailSend =  new SendMail();

                if (!$mailSend->send($email,$subject,$message)) {
                    $_SESSION['error'] = 'Email sending failed.';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                } else {
                    $_SESSION['message'] = 'Mail Sent.';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                }
            } else {
                $_SESSION['error'] = 'User not found.';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
        }
        $this->view('admin/auth/forgot-password');
    }

    public function  reset_password(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
            $token = $_GET['token'];
            $userModel = new User();
            $user = $userModel->find(['reset_token'=>$token,'role'=>'admin']);
        
            if ($user && new DateTime() < new DateTime($user['reset_token_expires'])) {
                $_SESSION['reset_token'] = $token; 
                $this->view('admin/auth/reset-password');
                exit;
            } else {
                $_SESSION['error'] = 'Token is invalid or has expired.';
                header('Location: '.APP_URL.'/forgot-password');
                exit;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_SESSION['reset_token'])) {
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userModel = new User();
            $userModel->update(['reset_token'=>$_SESSION['reset_token'],'role'=>'admin'],['password'=>$newPassword]);
            $_SESSION['message'] = 'Your password has been updated.';
            header('Location: '.APP_URL.'/admin/login');
            exit;
        }
    }
}
