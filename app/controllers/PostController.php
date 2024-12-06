<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller {


    public function details($params) {
        $slug = $params['slug'];
        $postModel = new Post();
        $post = $postModel->find(['slug'=>$slug]);
        $commentModel = new Comment();
        $comments = $commentModel->getCommentsWithDetails($post['id'],'approved');
        $this->view('post',['post'=>$post,'comments'=>$comments]);
    }


    public function add_comment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = Validator::sanitize($_POST['post_id']);
            $comment = Validator::sanitize($_POST['comment']);
        
            $commentModel =  new Comment();
            $commentModel->insert([
                'user_id'=>$_SESSION['user_id'],
                'post_id'=>$post_id,
                'comment'=>$comment,
            ]);
            $_SESSION['message'] = 'Comment Added Wait For Admin Approval';
            $redirectUrl = $_SERVER['HTTP_REFERER'];
            header('Location: ' . $redirectUrl);
            exit;
        }else{
            $redirectUrl = $_SERVER['HTTP_REFERER'];
            header('Location: ' . $redirectUrl);
            exit;
        }
    }
}
