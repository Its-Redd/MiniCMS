<?php

  require_once "includes/connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>
<body>
    <div class="page-wrapper">
        <header class="page-header"><nav class="admin-menu">
    <ul>
        <li><a href="../index.php">Goto homepage</a></li>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="../includes/logout.php">Logout</a></li>
    </ul>
</nav>
</header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Dashboard</h1>
            <p>In this section you can create, edit and delete users</p>
            

            <h2 class="page-title-sub">Latest Posts</h2>
            <div class="btn-group"><a href="post-create.php" class="action-btn">Create Post</a></div>
            <?php
            
              // CREATE TABLE HEADER AS STATIC HTML
              echo "<table class='admin-table'>";
              echo "<thead>
                      <th>Post Title</th>
                      <th>Post Author</th>
                      <th>Published</th>
                      <th>Rediger</th>
                      <th>Slet</th>
                  </thead>";
              echo "<tbody>";

              $sql = "SELECT posts.*, users.Firstname, users.Lastname 
              FROM posts 
              JOIN users ON posts.post_author = users.Id 
              ORDER BY posts.post_published DESC 
              LIMIT 3";
      
            $result = $conn->query($sql);
            
            if ($result) { // Ensure the query was successful
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row->post_title) . "</td>";
                    echo "<td>" . htmlspecialchars($row->Firstname . " " . $row->Lastname) . "</td>"; // Get full name
                    echo "<td>" . htmlspecialchars($row->post_published) . "</td>";
                    echo "<td><a href='post-update.php?post_id=" . urlencode($row->Id) . "'>Edit</a></td>";
                    echo "<td><a href='post-delete.php?post_id=" . urlencode($row->Id) . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }
      
              
              echo "</tbody>";
              echo "</table>";
              
            
            ?>




            <h2 class="page-title-sub">Latest Users</h2>
            <div class="btn-group"><a href="post-create.php" class="action-btn">Create User</a></div>


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

                $sql = "SELECT * FROM users ORDER BY Created DESC LIMIT 3";
                $result = $conn->query($sql); // Correct variable name
                
                if ($result) { // Ensure the query was successful
                    while ($row = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row->Firstname) . "</td>";
                        echo "<td>" . htmlspecialchars($row->Lastname) . "</td>";
                        echo "<td>" . htmlspecialchars($row->Username) . "</td>";
                        echo "<td>" . htmlspecialchars($row->Created) . "</td>";
                        echo "<td><a href='user-update.php?user_id=" . urlencode($row->Id) . "'>Edit</a></td>";
                        echo "<td><a href='user-delete.php?user_id=" . urlencode($row->Id) . "'>Delete</a></td>";
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