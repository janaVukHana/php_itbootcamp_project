<?php
session_start();
if(isset($_SESSION['username'])) {
    header('Location: home_page_controler.php');
}

require_once __DIR__ . '/models/DB.php';

require_once __DIR__ . '/models/Users.php';

$page = 'Login page';
$username_password_match = true;

if(isset($_POST['log_in'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $users = new Users();
    $user_is_logged = $users->log_in($username, $password);

    if($user_is_logged) {
        $user = new Users();
        $user_data = $user->get_user($username);
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['img'] = $user_data['img'];
        header('Location: courts_page_controler.php');
    }

    $username_password_match = false;
}

require __DIR__ . '/views/_layout/v-header.php';

require __DIR__ . '/views/v-login_page.php';

require __DIR__ . '/views/_layout/v-footer.php';