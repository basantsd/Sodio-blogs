<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Post extends Model {
    protected $table = 'posts';

    public function getPostsWithCategory() {
        $sql = "SELECT posts.*, categories.name AS category_name 
                FROM {$this->table} 
                JOIN categories ON posts.category_id = categories.id ORDER BY posts.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
