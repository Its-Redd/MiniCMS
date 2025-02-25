<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("connection.php");

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
 }

if (isset($_GET['Id'])) {
    $post_id = $_GET['Id'];

    if (!isset($_GET['confirm'])) {
        echo "Confirm to delete the post? <a href='post-delete.php?Id=$post_id&confirm=yes'>Yes</a> | <a href='posts.php'>No</a>";
    } else {
        // Delete record from database table
        $sql = "DELETE FROM posts WHERE Id = {$post_id}";
        $result = $conn->query($sql);
        header("Location: ../posts.php");
        exit();
    }
}
?>
