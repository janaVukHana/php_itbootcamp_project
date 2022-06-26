<?php

// include 'DB.php';

class Courts extends DB {
    
    /**
     * This function return all courts from db - first LAST added
     * @return array
     */
    public function get_all_courts(): array {
            $sql = "SELECT * FROM `courts` ORDER BY created_at DESC";
            $st = $this->connect()->query($sql);
    
            $rows= $st->fetchAll();
            return $rows;
    }

     /**
     * This function return all courts from db - first FIRST added
     * @return array
     */
    public function get_oldest_courts(): array {
        $sql = "SELECT * FROM `courts` ORDER BY created_at ASC";
        $st = $this->connect()->query($sql);

        $rows= $st->fetchAll();
        return $rows;
    }


    /**
     * This function return all courts from db - hard FIRST
     * @return array
     */
    public function get_hard_court(): array {
        $sql = "SELECT * FROM `courts` ORDER BY avg_rating DESC";
        $st = $this->connect()->query($sql);

        $rows= $st->fetchAll();
        return $rows;
    }


    /**
     * This function return all courts from db - easy FIRST
     * @return array
     */
    public function get_easy_court(): array {
        $sql = "SELECT * FROM `courts` ORDER BY avg_rating ASC";
        $st = $this->connect()->query($sql);

        $rows= $st->fetchAll();
        return $rows;
    }


    /**
     * This function return array of courts filtered by location
     * @param string $location
     * @return array
     */
    public function get_court_by_location(string $location): array {
        $sql = "SELECT * FROM `courts` WHERE `location` LIKE :location";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':location', $location);
        $st->execute();
        $rows = $st->fetchAll();
        return $rows;
    }


    /**
     * This function return one court id or false if there is no that id
     * @param string $id
     * @return array mixed
     */
    public static function get_one_by_id(string $id): mixed {
        $sql = "SELECT * FROM `courts` WHERE id LIKE :id";
        $pdo = new DB();

        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':id', $id);
        $st->execute();

        $row = $st->fetch();

        if($row == null) {
            return false;
        }

        return $row;
    }



    /**
     * This function return boolean value if everything is ok with inserting data in database
     * @param string $court_name
     * @param string $court_location
     * @param string $file_path
     * @param string $court_description
     * @return bool
     */
    public function add_court(string $court_name, string $court_location, string $file_path, string $court_description, string $post_creator): bool {
        $sql = "INSERT INTO `courts`(`name`, `location`, `file_path`, `description`, `creator`) VALUES 
        (:name, :location, :file_path, :description, :creator)";
        $st = $this->connect()->prepare($sql);
        $st->bindValue(':name',$court_name);
        $st->bindValue(':location',$court_location);
        $st->bindValue(':file_path',$file_path);
        $st->bindValue(':description',$court_description);
        $st->bindValue(':creator',$post_creator);
        
        $result = $st->execute();
        if($result){
            return true;
        } else {
            return false;
        }

    }


    /**
     * This function update total rating to the current court and num of comments update by 1 and avg_rating
     * @param string $rating
     * @param string $comment
     * @param string $avg_rating
     * @param string $id
     * @return void
     */
    public static function update_court_rating_and_comments(string $rating, string $comment, string $avg_rating, string $id): void {
        $sql = "UPDATE `courts` SET `total_rating`=:rating,`comments_num`=:comment,`avg_rating`=:avg_rating WHERE id LIKE :id";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':rating', $rating);
        $st->bindValue(':comment', $comment);
        $st->bindValue(':avg_rating', $avg_rating);
        $st->bindValue(':id', $id);
        $st->execute();
    }


    /**
     * This function get current court total rating and num of comments
     * @param string $id
     * @return 
     */
    public static function get_total_rating_and_comments(string $id) {
        $sql = "SELECT `total_rating`, `comments_num` FROM `courts` WHERE id LIKE :id";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':id', $id);
        $st->execute();

        $result = $st->fetch();
        return $result;
    }


}

