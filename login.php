<?php
session_start();

require_once "admin/includes/connection.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);

if (isset($_POST['submit'])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT Id, Username, Password FROM users WHERE Username = '$username'";
    $result = mysqli_query($conn, $query);

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
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <input type="submit" name="submit" value="Login">

                <?php if (isset($error_message) && $error_message != ""): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
            </form>
        </div>
    </main>

</body>

</html>