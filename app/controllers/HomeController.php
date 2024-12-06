<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Models\Post;

class HomeController extends Controller {
    public function index() {
        $postModel = new Post();
        $posts = $postModel->getPostsWithCategory();
        $this->view('home', ['posts' => $posts]);
    }
}
