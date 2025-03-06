<?php

session_start();
require_once "includes/connection.php";

/**
 * Redirects the user to the login page if they are not logged in.
 * 
 * This check ensures that only authenticated users can access the user update page.
 * If the 'user_id' is not set in the session, the user is redirected to the login page.
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}



/**
 * This script updates user information based on the user ID.
 * 
 * If a user ID is provided via the GET parameter 'Id', it retrieves the user information
 * from the database and stores the user ID in the session.
 * 
 * If no user ID is provided via the GET parameter, it retrieves the user ID from the session
 * and fetches the user information from the database.
 * 
 * @param mysqli $conn The MySQLi connection object.
 * @param int $user_id The ID of the user to be updated.
 * @return void
 */
if (isset($_GET['Id'])) {
    $user_id = $_GET['Id'];
    $_SESSION['user_id'] = $user_id;
    $result = FindUser($conn, $user_id);
    $row = $result->fetch_object();
} else {
    $user_id = $_SESSION['user_id'];
    $result = FindUser($conn, $user_id);
    $row = $result->fetch_object();
}

$status = "";

/**
 * Updates user information in the database.
 *
 * This script processes the form submission for updating a user's details.
 * It retrieves the user's first name, last name, username, and password from the POST request,
 * constructs an SQL UPDATE query, and executes it to update the user's information in the database.
 * After the update, it fetches the updated user information and sets a status message based on the result.
 *
 * @param string $user_firstname The first name of the user.
 * @param string $user_lastname  The last name of the user.
 * @param string $user_username  The username of the user.
 * @param string $user_password  The password of the user.
 * @param int    $user_id        The ID of the user to be updated.
 * @param object $conn           The database connection object.
 * @param object $result         The result of the SQL query execution.
 * @param object $updated        The updated user information fetched from the database.
 * @param object $row            The fetched user information as an object.
 * @param string $status         The status message indicating the result of the update operation.
 */
if (isset($_POST['submit'])) {

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
    $row = $updated->fetch_object();

    if (isset($result)) {
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