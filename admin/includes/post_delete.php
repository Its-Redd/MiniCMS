<?php
session_start();

require_once("connection.php");



/**
 * This script checks if the user is logged in by verifying the presence of 'user_id' in the session.
 * If the user is not logged in, they are redirected to the login page.
 *
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: .../login.php');
}



/**
 * Deletes a post from the database if the post ID is provided in the URL.
 * 
 * This script checks if a 'post_id' is set in the GET request. If the 'confirm' parameter
 * is not set in the GET request, it sets a confirmation message. If the 'confirm' parameter
 * is set, it deletes the post with the specified ID from the 'posts' table in the database
 * and redirects to the posts page.
 * 
 * @param int $_GET['post_id'] The ID of the post to be deleted.
 * @param string $_GET['confirm'] Optional. If set, confirms the deletion of the post.
 * 
 * @global object $conn The database connection object.
 */
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    if (!isset($_GET['confirm'])) {
        $confirm = "Confirm to delete the user?";
    } else {
        // Delete record from database table
        $sql = "DELETE FROM posts WHERE Id = {$post_id}";
        $result = $conn->query($sql);
        header("Location: ../posts.php");
    }
}
