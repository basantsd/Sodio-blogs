<?php

namespace App\Controllers\Admin;
use App\Core\Controller;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller {
    public function index() {
        $userModel = new User();
        $postModel = new Post();
        $activeUser = $userModel->count(['role'=>'user','status'=>'active']);
        $inactiveUser = $userModel->count(['role'=>'user','status'=>'inactive']);
        $totalPost = $postModel->count();
        $this->view('admin/dashboard',['activeUser'=>$activeUser,'inactiveUser'=>$inactiveUser,'totalPost'=>$totalPost]);
    }

}
