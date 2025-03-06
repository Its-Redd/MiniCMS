<?php
session_start();

require_once("connection.php");



/**
 * This script checks if the user is logged in by verifying if the 'user_id' 
 * is set in the session. If the 'user_id' is not set, it redirects the user 
 * to the login page.
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: .../login.php');
}



/**
 * Deletes a user from the database if the 'Id' parameter is set in the URL.
 * If the 'confirm' parameter is not set, prompts for confirmation.
 * 
 * URL Parameters:
 * - Id: The ID of the user to be deleted.
 * - confirm (optional): If set, confirms the deletion and proceeds to delete the user.
 * 
 * Database Actions:
 * - Deletes the user record from the 'users' table where the 'Id' matches the provided user ID.
 * 
 * Redirects to:
 * - ../users.php after the user is deleted.
 * 
 * @global mysqli $conn The MySQLi connection object.
 */
if (isset($_GET['Id'])) {
    $user_id = $_GET['Id'];

    if (!isset($_GET['confirm'])) {
        $confirm = "Confirm to delete the user?";
    } else {
        // Delete record from database table
        $sql = "DELETE FROM users WHERE Id = {$user_id}";
        $result = $conn->query($sql);
        header("Location: ../users.php");
    }
}
