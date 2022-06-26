<?php

// include 'DB.php';

class Comments extends DB {
    
    
    /**
     * This function return array of comments
     * @param string $id
     * @return array
     */
    public function get_all_comments(string $id): array {
        // $sql = "SELECT * FROM `court_comments`";
        // $pdo = new DB();
        // $st = $pdo->connect()->query($sql);
        
        // $rows= $st->fetchAll();
        // return $rows;
        $sql = "SELECT * FROM `court_comments` WHERE court_id LIKE :id ORDER BY created_at DESC";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':id', $id);
        
        $st->execute();
        $rows = $st->fetchAll();
        return $rows;
    }

    public function add_comment($court_id, $comment, $rating, $creator) {
        $sql = "INSERT INTO `court_comments`(`court_id`, `comment`, `rating`, `creator`) VALUES 
        (:court_id, :comment, :rating, :creator)";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':court_id', $court_id);
        $st->bindValue(':comment', $comment);
        $st->bindValue(':rating', $rating);
        $st->bindValue(':creator', $creator);
        
        $result = $st->execute();

        if($result) {
            return true;
        } else {
            return false;
        }
    }

}

