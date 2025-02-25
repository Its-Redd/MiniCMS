<?php

  require_once "includes/connection.php";

  if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
 }
?>

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $status = "";

    if(isset($_POST['submit'])){
        if(!empty($_POST['user_firstname']) || !empty($_POST['user_astname']) || !empty($_POST['user_username']) || !empty($_POST['user_password'])){
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];

            $sql = "INSERT INTO users (Firstname, Lastname,
            Username, Password, Created) VALUES ('$user_firstname', '$user_lastname', '$user_username', '$user_password', NOW())";

            if($conn->query($sql) === TRUE){
                $status = "<p>User was created successfully</p>";
            } else {
                $status = "<p>An error occured, user was not created</p>";
            }
        } else {
            echo "All fields are required";

        }
    



        

        

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>
<body>
    <div class="page-wrapper">
    <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Create User</h1>
            <p>In this section you can create users</p>
            
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

            <?php
            
              echo $status
            
            ?>
        </main>
    </div>
</body>
</html>