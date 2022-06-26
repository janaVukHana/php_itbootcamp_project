<?php
session_start();

require_once __DIR__ . '/models/DB.php';
require_once __DIR__ . '/models/Users.php';
// next four lines are when user is logged and want to change profile image
require_once __DIR__ . '/models/handle_header_form.php';
$header_form_err = false;
$modal_systemErrors = [];
handle_header_form();

$page = 'Home page';

// if session is set show add court page, else show login/signup buttons
$is_set_session = false;
if(isset($_SESSION['username'])) {
    $is_set_session = true;
}

require __DIR__ . '/views/_layout/v-header.php';

require __DIR__ . '/views/v-home_page.php';

require __DIR__ . '/views/_layout/v-footer.php';