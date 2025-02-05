<?php

  require_once "includes/connection.php";

?>

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];

        $sql = "SELECT * FROM users WHERE Id = $user_id";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_object();
        }

    }

    if(isset($_POST['submit'])){

        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $user_username  = $_POST['user_username'];
        $user_password  = $_POST['user_password'];
    
        $sql = "UPDATE users SET
            User_firstname = '{$user_firstname}',
            User_lastname  = '{$user_lastname}',
            user_username  = '{$user_username}',
            user_password  = '{$user_password}'
            WHERE id = '{$user_id}'";
    
        $result = $conn->query($sql);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>
<body>
    <div class="page-wrapper">
    <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <div class="inner-wrapper-narrow">
            <h1 class="page-title">Mini CMS | Update User</h1>
            <p>Submit form to update user</p>
            
            <form action="user-create.php" method="post">
            <div class="form-item">
                <label for="user-firstname" class="label">First name:</label>
                <div class="field">
                    <input name="user_firstname" type="text" id="user-firstname" value="" autofocus required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-lastname" class="label">Last name:</label>
                <div class="field">
                    <input name="user_lastname" type="text" id="user-lastname" value="" required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-email" class="label">Email:</label>
                <div class="field">
                    <input name="user_email" type="text" id="user-email" value="" required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-username" class="label">Username:</label>
                <div class="field">
                    <input name="user_username" type="text" id="user-username" value="" required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-password" class="label">Password:</label>
                <div class="field">
                    <input name="user_password" type="text" id="user-password" value="" required>
                </div>
                </div>
                <button type="submit" name="submit">Create user</button>
            </form>
            </div>

            
        </main>
    </div>
</body>
</html>