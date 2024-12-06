<?php

namespace App\Controllers\Admin;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\Category;

class CategoryController extends Controller {
    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->get();
        $this->view('admin/category/index',['categories'=>$categories]);
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = 'CSRF token validation failed';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
            $name = Validator::sanitize($_POST['name']);  // Validate and sanitize input
            if (!$name || $name == '') {
                $_SESSION['error'] = 'Invalid category name';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                $categoryModel = new Category();
                $categoryModel->insert(['name' => $name]);
                $_SESSION['message'] = 'Category created successfully';
                header('Location: '.APP_URL.'/admin/category'); 
            }
        }else{
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $this->view('admin/category/create');
        }
    }


    public function edit($params) {
        $id = $params['id'];
        $categoryModel = new Category();
        $category = $categoryModel->find(['id' => $id]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = 'CSRF token validation failed';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            }
            $name = Validator::sanitize($_POST['name']);
            if (!$name || $name == '') {
                $_SESSION['error'] = 'Invalid category name';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                $categoryModel->update(['id' => $id], ['name' => $name]);
                $_SESSION['message'] = 'Category updated successfully';
                header('Location: '.APP_URL.'/admin/category');
            }
            $category = $categoryModel->find(['id' => $id]);
        }else{
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $this->view('admin/category/edit',['category'=>$category]);
        }
    }

    public function delete($params) {
        $id = $params['id'];
        $categoryModel = new Category();
        $categoryModel->delete(['id' => $id]);
        $_SESSION['message'] = 'Category deleted successfully';
        header('Location: '.APP_URL.'/admin/category');
    }

}
