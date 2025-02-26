<?php
session_start();

require_once "admin/includes/connection.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);

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
    }
    else {echo "Der er sket en fejl";}
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
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            
            <input type="submit" name="submit" value="Login">

            <?php if (isset($error) && $error != ""): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </form>
    </div>
    </main>

</body>

</html>