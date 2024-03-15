<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'routes/web.php';

if (isset($_SESSION)) {   
    $_SESSION['tracker_visited'] = $_SERVER['REQUEST_URI'];
    $_SESSION['tracker_date'] = date_create()->format('Y-m-d H:i:s'); 

}







?>

