<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("connection.php");

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
 }



if(isset($_GET['Id'])) {
    $user_id = $_GET['Id'];

    if(!isset($_GET['confirm'])){
        $confirm = "Confirm to delete the user?";
    }
    else {
        // Delete record from database table
        $sql = "DELETE FROM users WHERE Id = {$user_id}";
        $result = $conn->query($sql);
        header("Location: ../users.php");
    }
}
?>
