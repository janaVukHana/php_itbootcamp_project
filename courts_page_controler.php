<?php
session_start();

require_once __DIR__ . '/models/DB.php';
require_once __DIR__ . '/models/Courts.php';
require_once __DIR__ . '/models/Users.php';
// next four lines are when user is logged and want to change profile image
require_once __DIR__ . '/models/handle_header_form.php';
$header_form_err = false;
$modal_systemErrors = [];
handle_header_form();

// if session is set show add court page
$is_set_session = false;
if(isset($_SESSION['username'])) {
    $is_set_session = true;
}

// get courts from db
$courts = new Courts();
$all_courts = $courts->get_all_courts();

$page = 'Courts page';

$court_location = '';
if(isset($_GET['court_location'])) {
    $court_location = $_GET['court_location'];
    if($court_location == 'Newest') {
        $all_courts = $courts->get_all_courts();
    } else if ($court_location == 'Oldest') {
        $all_courts = $courts->get_oldest_courts();
    } else if ($court_location == 'Hardest') {
        $all_courts = $courts->get_hard_court();
    } else if ($court_location == 'Easiest') {
        $all_courts = $courts->get_easy_court();
    } else {
        $all_courts = $courts->get_court_by_location($court_location);
    }
}

// require_once __DIR__ . '/models/Users.php';

require __DIR__ . '/views/_layout/v-header.php';

require __DIR__ . '/views/v-courts.php';

require __DIR__ . '/views/_layout/v-footer.php';