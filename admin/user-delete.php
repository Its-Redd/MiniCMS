<?php

  require_once "includes/connection.php";

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


    if(isset($_GET['user_id'])) {
        $user_id = $_GET['Id'];
        $_SESSION['user_id'] = $user_id;
        FindUser($conn, $user_id);

        // Delete record from database table
        $sql = "DELETE FROM users WHERE Id = {$user_id}";
        $result = $con->query($sql);
        header('Location: admin\users.php');

    }



?>