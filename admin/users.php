<?php
session_start();

require_once "includes/connection.php";

// Redirect the user to the login page if they are not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Users</h1>
            <p>In this section you can create, edit and delete users</p>




            <h2 class="page-title-sub">Latest Users</h2>
            <div class="btn-group"><a href="user-create.php" class="action-btn">Create User</a></div>


            <?php
            // CREATE TABLE HEADER AS STATIC HTML
            echo "<table class='admin-table'>";
            echo "<thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Created</th>
                        <th>Rediger</th>
                        <th>Slet</th>
                    </thead>";
            echo "<tbody>";

            $sql = "SELECT * FROM users ORDER BY Created DESC";
            $result = $conn->query($sql); // Correct variable name

            // Display a row for each user
            if ($result) { // Ensure the query was successful
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars(trim($row->Firstname)) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($row->Lastname)) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($row->Username)) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($row->Created)) . "</td>";
                    echo "<td><a href='user-update.php?Id=" . urlencode($row->Id) . "'>Edit</a></td>";
                    echo "<td><a href='user-delete.php?Id=" . urlencode($row->Id) . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }

            echo "</tbody>";
            echo "</table>";




            ?>


        </main>
    </div>
</body>

</html>