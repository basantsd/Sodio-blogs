<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Comment extends Model {
    protected $table = 'comments';

   
    public function getCommentsWithDetails($postId = null, $isApproved = null) {
        $conditions = [];
        $params = [];
    
        if ($postId) {
            $conditions[] = 'posts.id = :postId';
            $params[':postId'] = $postId;
        }
    
        if ($isApproved !== null) {
            $conditions[] = 'comments.is_approved = :isApproved';
            $params[':isApproved'] = $isApproved;
        }
    
        $sql = "SELECT comments.*, users.name, posts.title
                FROM comments
                JOIN users ON comments.user_id = users.id
                JOIN posts ON comments.post_id = posts.id";
    
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        $sql .= " ORDER BY comments.id DESC";
    
        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
