<?php
session_start();

require_once __DIR__ . '/models/DB.php';
require_once __DIR__ . '/models/Courts.php';
require_once __DIR__ . '/models/Comments.php';
require_once __DIR__ . '/models/test_input.php';
// next four lines are when user is logged and want to change profile image
require_once __DIR__ . '/models/handle_header_form.php';
$header_form_err = false;
$modal_systemErrors = [];
handle_header_form();

// if sesssion is set show add court page
// and show add comment form
$is_set_session = false;
if(isset($_SESSION['username'])) {
    $is_set_session = true;
}

$page = 'Single Court page';
$systemErrors = [];

// if there is no query on page or id is no in database give me 404 page 
$court_id = $_GET['id'];
if($court_id == null) {
    header('Location: page_404_controler.php');
} 
if(!Courts::get_one_by_id($court_id)) {
    header('Location: page_404_controler.php');
};

$comments = new Comments();

if(isset($_POST['add_comment'])) {
    // validate comment
    // COMMENT: not empty, min 30 max 100 characters, trim
    if (empty($_POST['comment'])) {
        $systemErrors['comment_err'] = "* Comment is required";
      } 
      else {
        $comment = test_input($_POST["comment"]);
        if(strlen($comment) < 30 || strlen($comment) > 100) {
            $systemErrors['comment_err'] = '* Comment must contain between 30 and 100 chars.';
        }
    }
    // validate rating
    if (empty($_POST['rating'])) {
        $systemErrors['rating_err'] = "* Rating is required";
    } else {
        $rating = $_POST['rating'];

        if(!is_numeric($rating) || ($rating - intval($rating) != 0 || $rating > 5 || $rating < 1)){ 
            $systemErrors['rating_err'] = "* You must enter whole number from 1 to 5";
        } 
    }

    if (count($systemErrors) == 0) {
        $comments->add_comment($court_id, $comment, $rating, $_SESSION['username']);
        // update court rating and num
        $rating_and_comments_num = Courts::get_total_rating_and_comments($court_id);

        $old_rating = $rating_and_comments_num['total_rating'];
        $old_comments_num = $rating_and_comments_num['comments_num'];
        
        $new_rating = $old_rating + $rating;
        $new_comments_num = $old_comments_num + 1;

        $avg_rating = $new_rating / $new_comments_num;
        // print_r($new_rating);
        // print_r($new_comments_num);
        
        Courts::update_court_rating_and_comments($new_rating, $new_comments_num, $avg_rating, $court_id);

        // clear inputs
        $comment = '';
        $rating = '';
    }

}


$court = Courts::get_one_by_id($court_id);
$user_comments = $comments->get_all_comments($court_id);


require __DIR__ . '/views/_layout/v-header.php';

require __DIR__ . '/views/v-single_court.php';

require __DIR__ . '/views/_layout/v-footer.php';