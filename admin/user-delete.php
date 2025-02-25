<?php

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
 }

if(isset($_GET['Id'])) {
    $user_id = $_GET['Id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>
<body>
    <div class="page-wrapper">
    <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Delete User</h1>
            <?php if(isset($confirm)){echo $confirm;}?>
            <a href="includes/user_delete.php?Id=<?php echo $user_id; ?>&confirm=true">Confirm</a> | 
            <a href="users.php">Cancel</a>

        </main>
    </div>
</body>
</html>