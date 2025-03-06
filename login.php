<?php
session_start();

require_once "admin/includes/connection.php";



/**
 * Handles the login process when the form is submitted.
 *
 * This script checks if the login form has been submitted. If so, it retrieves the username and password
 * from the POST request and queries the database to find a matching user. If a match is found, the user's
 * session is initialized and the user is redirected to the admin index page. If no match is found, an error
 * message is set. If an error occurs during the query, an error message is displayed.
 *
 * @global object $conn The database connection object.
 * @global array $_SESSION The session array to store user information.
 *
 * @param string $_POST["submit"] The submit button value to check if the form is submitted.
 * @param string $_POST["username"] The username entered by the user.
 * @param string $_POST["password"] The password entered by the user.
 *
 * @return void
 */
if (isset($_POST["submit"])) {
    // ob_start(); // Start output buffering
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE Username = '{$username}' AND Password = '{$password}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $aut_user = $result->fetch_object();
        $_SESSION["user_id"] = $aut_user->Id;
        $_SESSION["username"] = $aut_user->Username;
        header("Location: /admin/index.php");
        var_dump($_SESSION);
        echo "It worked";
        exit();
    } elseif ($result->num_rows == 0) {
        $error = "Det indtastede brugernavn eller adgangskode er forkert";
    } else {
        echo "Der er sket en fejl";
    }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT Id, Username, Password FROM users WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $aut_user = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $aut_user['Password'])) {

            $_SESSION['user_id'] = $aut_user['Id'];
            $_SESSION['username'] = $aut_user['Username'];

            header("Location: admin/index.php");
            exit();
        } else {
            $error_message = "Incorrect username or password. Please try again!";
        }
    } else {
        $error_message = "Incorrect username or password. Please try again!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>

    </header>

    <main>
        <div class="login-wrapper">
            <h1>Login</h1>
            <form action="login.php" method="POST">

                <label for="username">Username T</label>

                <label for="username">Username</label>

                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <input type="submit" name="submit" value="Login">


                <?php if (isset($error) && $error != ""): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>

                <?php if (isset($error_message) && $error_message != ""): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
                <?php if (isset($error_message) && $error_message != ""): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
    </main>

</body>

</html>