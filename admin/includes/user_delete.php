<?php
session_start();

require_once("connection.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: .../login.php');
    exit();
}

if (isset($_GET['Id'])) {
    $user_id = $_GET['Id'];

    // Check the number of users in the database
    $user_count_sql = "SELECT COUNT(*) as user_count FROM users";
    $user_count_result = $conn->query($user_count_sql);
    $user_count_row = $user_count_result->fetch_assoc();

    if ($user_count_row['user_count'] <= 1) {
        echo "Cannot delete the last user.";
        exit();
    }

    if (!isset($_GET['confirm'])) {
        $confirm = "Confirm to delete the user?";
        // You should implement a confirmation mechanism here
    } else {
        // Delete record from database table
        $sql = "DELETE FROM users WHERE Id = {$user_id}";
        $result = $conn->query($sql);
        header("Location: ../users.php");
        exit();
    }
}
