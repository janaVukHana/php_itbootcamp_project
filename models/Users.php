<?php
// include 'DB.php';

class Users extends DB {
    
    /**
     * This function return is user logged or not (boolean value)
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function log_in(string $username, string $password):bool {
        $user_is_logged = false;
        $sql = "SELECT * FROM `login`";
        // $st = $stmt = statement
        $st = $this->connect()->query($sql);
        
        while($row = $st->fetch()) {
            if($row['username'] == $username && password_verify($password, $row['password'])) {
                $user_is_logged = true;
            }
        }
        return $user_is_logged;
    }

    /**
     * This function return boolean value did user successufuly make registration
     * @param string $username
     * @param string $username
     * @param string $password
     * @param string $img
     * @return bool
     */
    public function registration(string $username, string $email, string $password, string $img):bool {

        // $sql = "SELECT count(username) AS num FROM users Where username=?;";
        $sql = "SELECT count(username) AS num FROM `login` WHERE username=?";

        $pdo = new DB();
        $stmt= $pdo->connect()->prepare($sql);
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        if($row['num']>0){
            // die('User already exists');
            // echo 'User already exists';
            return false;
        }

        
        $passwordHash = password_hash($password,PASSWORD_BCRYPT, array("cost"=>12));
        $sql = "INSERT INTO `login` (username,email,password, img) VALUES(:username,:email,:password,:img);";
        $stmt=$pdo->connect()->prepare($sql);
        $stmt->bindValue(':password',$passwordHash);
        $stmt->bindValue(':username',$username);
        // $stmt->bindValue(':password',$password);
        $stmt->bindValue(':email',$email);
        $stmt->bindValue(':img',$img);

        $result = $stmt->execute();
        if($result){
            return true;
        } 
    }

    /**
     * This function return one user data
     * @param string $username
     * @return array
     */
    public function get_user(string $username): array {
        $sql = "SELECT * FROM `login` WHERE username LIKE :username;";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':username', $username);
        $st->execute();

        $user = $st->fetch();
        return $user;
    }


    /**
     * This function change/update profile image
     * @param string $username
     * @param string $image
     * @return void
     */
    public function change_profile_image(string $image, string $username): void {
        $sql = "UPDATE `login` SET `img`=:img WHERE `username`=:username";
        $pdo = new DB();
        $st = $pdo->connect()->prepare($sql);
        $st->bindValue(':img', $image);
        $st->bindValue(':username', $username);
        $st->execute();
    }

    
}


