<?php
session_start();
require_once "includes/connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Posts</h1>
            <p>In this section, you can create, edit, and delete posts.</p>

            <h2 class="page-title-sub">Latest Posts</h2>
            <div class="btn-group">
                <a href="post-create.php" class="action-btn">Create Post</a>
            </div>

            <?php
            // Display Posts Table
            echo "<table class='admin-table'>";
            echo "<thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>";
            echo "<tbody>";

            // Fetch all posts from the database
            $sql = "SELECT * FROM posts ORDER BY post_published DESC";
            $result = $conn->query($sql);

            // Display a row for each post
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row->post_title) . "</td>";
                    echo "<td>" . htmlspecialchars($row->post_author) . "</td>";
                    echo "<td>" . htmlspecialchars($row->post_published) . "</td>";
                    echo "<td><a href='post-update.php?Id=" . urlencode($row->Id) . "' class='edit-btn'>Edit</a></td>";
                    echo "<td><a href='post-delete.php?Id=" . urlencode($row->Id) . "' class='delete-btn'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No posts found</td></tr>";
            }

            echo "</tbody>";
            echo "</table>";
            ?>
        </main>
    </div>
</body>

</html>