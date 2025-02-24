<?php

    session_start();
  require_once "includes/connection.php";


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(isset($_GET['Id'])){
        $user_id = $_GET['Id'];
        $_SESSION['user_id'] = $user_id;
        $result = FindUser($conn, $user_id);
        $row = $result->fetch_object();
    }
    else{
        $user_id = $_SESSION['user_id'];
        $result = FindUser($conn, $user_id);
        $row = $result->fetch_object(); 
    }
    // else{
    //     header("Location: users.php");
    //     die();
    // }

    // function FindUser($conn, $user_id) : object {
    //     $sql = "SELECT * FROM users WHERE Id = $user_id";

        
    //     return $result = $conn->query($sql);
    // }

    $status = "";

    if(isset($_POST['submit'])){
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $user_username  = $_POST['user_username'];
        $user_password  = $_POST['user_password'];
    
        $sql = "UPDATE users SET
            Firstname = '{$user_firstname}',
            Lastname  = '{$user_lastname}',
            Username  = '{$user_username}',
            Password  = '{$user_password}'
            WHERE id = '{$user_id}'";
    
        $result = $conn->query($sql);

        $updated = FindUser($conn, $user_id);
        $row = $updated ->fetch_object();
        
        if(isset($result)){
            $status = "User was updated successfully";
        } else {
            $status = "An error occured, user was not updated"; 
        }
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
            
            <form action="user-update.php" method="post">
            <div class="form-item">
                <label for="user-firstname" class="label">First name:</label>
                <div class="field">
                    <input name="user_firstname" type="text" id="user-firstname" value="<?php
                    
                      echo trim($row->Firstname);
                    
                    ?>" autofocus required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-lastname" class="label">Last name:</label>
                <div class="field">
                    <input name="user_lastname" type="text" id="user-lastname" value="<?php
                    
                        echo trim($row->Lastname);
                    
                    ?>" required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-username" class="label">Username:</label>
                <div class="field">
                    <input name="user_username" type="text" id="user-username" value="<?php
                    
                      echo trim($row->Username);
                    
                    ?>" required>
                </div>
                </div>
                <div class="form-item">
                <label for="user-password" class="label">Password:</label>
                <div class="field">
                    <input name="user_password" type="text" id="user-password" value="<?php
                    
                      echo trim($row->Password);

                      ?>" required>
                </div>
                </div>
                <button type="submit" name="submit">Update user</button>
            </form>
            <h2>
                <?php
                
                  echo $status;
                
                ?>
            </h2>
            </div>



            
        </main>
    </div>
</body>
</html>