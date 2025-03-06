<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
   setcookie(session_name(), '', time() - 36000, '/');
   session_destroy();
   header("Location: ../index.php");
}
