<?php 
session_start();

session_destroy();

header('Location: home_page_controler.php');