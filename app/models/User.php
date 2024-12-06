<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model {
    protected $table = 'users';

    public function getPosts() {
        $statement = $this->db->prepare("SELECT * FROM {$this->table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
