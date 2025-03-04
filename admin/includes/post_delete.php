<?php
session_start();

require_once("connection.php");



if(!isset($_SESSION['user_id'])){
    header('Location: .../login.php');
 }



if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    if(!isset($_GET['confirm'])){
        $confirm = "Confirm to delete the user?";
    }
    else {
        // Delete record from database table
        $sql = "DELETE FROM posts WHERE Id = {$post_id}";
        $result = $conn->query($sql);
        header("Location: ../posts.php");
    }
}
?>
