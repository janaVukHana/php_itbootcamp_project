<?php

function handle_header_form() {

    if(isset($_POST['change_img'])) {
       
        global $header_form_err;
        global $modal_systemErrors;
        // FILE: validate file upload
        // UPLOAD: file
        $allower_ext = ['png', 'jpg', 'jpeg', 'gif'];

        if(!empty($_FILES['upload']['name'])) {
            $file_name = $_FILES['upload']['name'];
            $file_size = $_FILES['upload']['size'];
            $file_tmp = $_FILES['upload']['tmp_name'];

            // KADA DODAM JOS JEDAN FOLDER NE RADI
            // PRIMER: public/theme/img/avatar/{$file_name}
            $target_dir = "public/theme/img/{$file_name}";

            // get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            
            if(in_array($file_ext, $allower_ext)) {
                if($file_size <= 1000000) {
                    if(empty($modal_systemErrors)) {
                        move_uploaded_file($file_tmp, $target_dir);
                    }
                } else {
                    $modal_systemErrors['file_err'] = '* File is too large.';
                }
            } else {
                $modal_systemErrors['file_err'] = '* Invalid file type.';
            }
        } else {
            $modal_systemErrors['file_err'] = '* Please choose a file.';
        }
        
        $header_form_err = count($modal_systemErrors) > 0 ? true : false;
        // pokazi poruku ako ima greske
        
        if(!$modal_systemErrors) {
            $image = $target_dir;
            $username = $_SESSION['username'];
            $user = new Users();
            $user->change_profile_image($image, $username);
            $image = $user->get_user($username);

            $_SESSION['img'] = $image['img'];
            header('Location: ' . $_SERVER["PHP_SELF"]);
        }
        
    }
}
