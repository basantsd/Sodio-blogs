<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller
{



    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getPostsWithCategory();
        $this->view('admin/posts/index', ['posts' => $posts]);
    }


    protected function makeSlug($title) {
        $slug = strtolower($title);
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
        if (function_exists('iconv')) {
            $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
        }
        $slug = preg_replace('~[^-\w]+~', '', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        return $slug;
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
            $title = Validator::sanitize($_POST['title']);
            $description = Validator::sanitize($_POST['description']);
            $categoryId = Validator::sanitize($_POST['category_id']);
            $publishDate = Validator::sanitize($_POST['publish_date']);
            $status = Validator::sanitize($_POST['status']);
            $destination = '';

            if ($_FILES['postfile']['error'] == UPLOAD_ERR_OK) {
                $tmpName = $_FILES['postfile']['tmp_name'];
                $fileName = basename($_FILES['postfile']['name']);
                $size = $_FILES['postfile']['size'];
                $type = $_FILES['postfile']['type'];

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($type, $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid file type';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                }

                // Move the uploaded file
                if ($size > 5000000) { // limit 5 MB
                    $_SESSION['error'] = 'File too large';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                }

                $destination = BASE_PATH . '/uploads/' . $fileName;
                if (!is_dir(BASE_PATH . '/uploads/')) {
                    if (!mkdir(BASE_PATH . '/uploads/', 0755, true)) {
                        $_SESSION['error'] = "Failed to create directory.";
                        header('Location: ' . APP_URL . '/admin/posts');
                        exit;
                    }
                } else if (!is_writable(BASE_PATH . '/uploads/')) {
                    $_SESSION['error'] = "Directory is not writable.";
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                }

                if (!move_uploaded_file($tmpName, $destination)) {
                    $_SESSION['error'] = 'Failed to move uploaded file';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
                }
            }

            if (!$title || $title == '') {
                $_SESSION['error'] = 'Invalid post title';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$description || $description == '') {
                $_SESSION['error'] = 'Invalid post description';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$categoryId || $categoryId == '') {
                $_SESSION['error'] = 'Invalid category';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$publishDate || $publishDate == '') {
                $_SESSION['error'] = 'Invalid publish date';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$status || $status == '') {
                $_SESSION['error'] = 'Invalid status';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else if (!$destination || $destination == '') {
                $_SESSION['error'] = 'Invalid post image';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                $postModel = new Post();
                $postModel->insert([
                    'title' => $title,
                    'slug'=> $this->makeSlug($title),
                    'description' => $description,
                    'category_id' => $categoryId,
                    'publish_date' => $publishDate,
                    'status' => $status,
                    'image' => $fileName ?? null
                ]);
                $_SESSION['message'] = 'Post created successfully';
                header('Location: ' . APP_URL . '/admin/posts');
                exit;
            }
        } else {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $categoryModel = new Category();
            $categories = $categoryModel->get();
            $this->view('admin/posts/create', ['categories' => $categories]);
        }
    }


    public function edit($params)
    {
        $id = $params['id'];
        $postModel = new Post();
        $post = $postModel->find(['id' => $id]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['error'] = 'CSRF token validation failed';
                $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                exit;
            }

            $title = Validator::sanitize($_POST['title']);
            $description = Validator::sanitize($_POST['description']);
            $categoryId = Validator::sanitize($_POST['category_id']);
            $publishDate = Validator::sanitize($_POST['publish_date']);
            $status = Validator::sanitize($_POST['status']);
            $existingImage = $post['image'] ?? '';


            if ($_FILES['postfile']['error'] != UPLOAD_ERR_NO_FILE) {
                $tmpName = $_FILES['postfile']['tmp_name'];
                $fileName = basename($_FILES['postfile']['name']);
                $size = $_FILES['postfile']['size'];
                $type = $_FILES['postfile']['type'];

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($type, $allowedTypes)) {
                    $_SESSION['error'] = 'Invalid file type';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                    exit;
                }

                // Move the uploaded file
                if ($size > 5000000) { // limit 5 MB
                    $_SESSION['error'] = 'File too large';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                    exit;
                }

                $existingImage = BASE_PATH . '/uploads/' . $fileName;
                if (!is_dir(BASE_PATH . '/uploads/')) {
                    if (!mkdir(BASE_PATH . '/uploads/', 0755, true)) {
                        $_SESSION['error'] = "Failed to create directory.";
                        $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                        exit;
                    }
                } else if (!is_writable(BASE_PATH . '/uploads/')) {
                    $_SESSION['error'] = "Directory is not writable.";
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                    exit;
                }

                if (!move_uploaded_file($tmpName, $existingImage)) {
                    $_SESSION['error'] = 'Failed to move uploaded file';
                    $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: '.$redirectUrl); 
                    exit;
                }
            }

            if (!$title || $title == '') {
                $_SESSION['error'] = 'Invalid post title';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else if (!$description || $description == '') {
                $_SESSION['error'] = 'Invalid post description';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else if (!$categoryId || $categoryId == '') {
                $_SESSION['error'] = 'Invalid category';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else if (!$publishDate || $publishDate == '') {
                $_SESSION['error'] = 'Invalid publish date';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else if (!$status || $status == '') {
                $_SESSION['error'] = 'Invalid status';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else if (!$existingImage || $existingImage == '') {
                $_SESSION['error'] = 'Invalid post image';
                 $redirectUrl = $_SERVER['HTTP_REFERER'];
                    header('Location: ' . $redirectUrl);
                    exit;
            } else {
                $updateData = [
                    'title' => $title,
                    'slug'=> $this->makeSlug($title),
                    'description' => $description,
                    'category_id' => $categoryId,
                    'publish_date' => $publishDate,
                    'status' => $status,
                    'image' => $fileName
                ];
                $postModel->update(['id' => $id], $updateData);
                $_SESSION['message'] = 'Post updated successfully';
                header('Location: ' . APP_URL . '/admin/posts');
                exit;
            }
        }


        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $categoryModel = new Category();
        $categories = $categoryModel->get();
        $this->view('admin/posts/edit', ['post' => $post, 'categories' => $categories]);
    }


    public function delete($params)
    {
        $id = $params['id'];
        $postModel = new Post();
        $postModel->delete(['id' => $id]);
        $_SESSION['message'] = 'Post deleted successfully';
        header('Location: ' . APP_URL . '/admin/posts');
    }



    public function comments(){
        $commentModel = new Comment();
        $comments = $commentModel->getCommentsWithDetails();
        $this->view('admin/comments/index', ['comments' => $comments]);
    }


    public function comment_status(){
        $comment_id = Validator::sanitize($_POST['comment_id']);
        $is_approved = Validator::sanitize($_POST['is_approved']);
        $commentModel = new Comment();
        $commentModel->update([
            'id'=>$comment_id
        ],
        [
            'is_approved'=>$is_approved
        ]);
        $_SESSION['message'] = 'Comments Status Update successfully';
        header('Location: ' . APP_URL . '/admin/comments');
    }
}
