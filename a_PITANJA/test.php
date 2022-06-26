<?php

$rating = '1';

if(!is_numeric($rating) || ($rating - intval($rating) != 0 || $rating > 5 || $rating < 1)){ 
    echo "* You must enter whole number from 1 to 5";
} 