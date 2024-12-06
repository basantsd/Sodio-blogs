<?php

namespace App\Controllers\Admin;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;

class UserController extends Controller {

    public function index()
    {
        $userModel = new User();
        $userStatus = $_REQUEST['status'] ?? 'all';
        if($userStatus != 'all'){
            $users = $userModel->get(['role'=>'user','status'=>$userStatus],['column'=>'created_at','direction'=>'DESC']);
        }else{
            $users = $userModel->get(['role'=>'user'],['column'=>'created_at','direction'=>'DESC']);
        }
        
        $this->view('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = 'CSRF token validation failed';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
            $name = Validator::sanitize($_POST['name']);
            $mobile_no = Validator::sanitize($_POST['mobile_no']);
            $email = Validator::sanitize($_POST['email']);

            $password = Validator::sanitize($_POST['password']);
            $status = Validator::sanitize($_POST['status']);

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
            } else if (!$status || $status == '') {
                $_SESSION['error'] = 'Invalid status';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }else if ($mobile_no && (!is_numeric($mobile_no) || strlen($mobile_no) < 10 || strlen($mobile_no) > 12)) {
                $_SESSION['error'] = 'Mobile number must be numeric and between 10 to 12 digits';
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
                    'mobile_no' => $mobile_no,
                    'email' => $email,
                    'password'=>$haspwd,
                    'status' => $status
                ]);
                $_SESSION['message'] = 'User created successfully';
                header('Location: ' . APP_URL . '/admin/users');
                exit;
            }
        } else {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $this->view('admin/users/create');
        }
    }


    public function edit($params)
    {
        $id = $params['id'];
        $userModel = new User();
        $user = $userModel->find(['id' => $id]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = 'CSRF token validation failed';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                exit;
            }

            $name = Validator::sanitize($_POST['name']);
            $mobile_no = Validator::sanitize($_POST['mobile_no']);
            $email = Validator::sanitize($_POST['email']);
            $password = Validator::sanitize($_POST['password']);
            $status = Validator::sanitize($_POST['status']);
            $haspwd = $password ? password_hash($password,PASSWORD_DEFAULT) : $user['password'];

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
            }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['error'] = 'Invalid email address';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$status || $status == '') {
                $_SESSION['error'] = 'Invalid status';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }else if ($mobile_no && (!is_numeric($mobile_no) || strlen($mobile_no) < 10 || strlen($mobile_no) > 12)) {
                $_SESSION['error'] = 'Mobile number must be numeric and between 10 to 12 digits';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else {

                $userModel = new User();
                $existingUser = $userModel->find(['email'=>$email]);
                if($existingUser && $email != $user['email']){
                    $_SESSION['error'] = 'Email already exists.';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                   header('Location: ' . $redirectUrl);
                   exit;
                }

                $updateData = [
                    'name' => $name,
                    'mobile_no' => $mobile_no,
                    'email' => $email,
                    'password'=>$haspwd,
                    'status' => $status
                ];
                $userModel->update(['id' => $id], $updateData);
                $_SESSION['message'] = 'User updated successfully';
                header('Location: ' . APP_URL . '/admin/users');
                exit;
            }
        }


        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $this->view('admin/users/edit', ['user' => $user]);
    }


    public function delete($params)
    {
        $id = $params['id'];
        $userModel = new User();
        $userModel->delete(['id' => $id]);
        $_SESSION['message'] = 'User deleted successfully';
        header('Location: ' . APP_URL . '/admin/users');
    }
}
