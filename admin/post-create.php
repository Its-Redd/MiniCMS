<?php
session_start();
require_once "includes/connection.php";

/**
 * Redirects the user to the login page if they are not logged in.
 * 
 * This script checks if the 'user_id' is set in the session. If not, it assumes
 * the user is not logged in and redirects them to the login page.
 * 
 * @file /C:/Repo/MiniCMS/admin/post-create.php
 */
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

$status = "";


/**
 * Handles the creation of a new post when the form is submitted.
 * 
 * This script checks if the form has been submitted and if all required fields
 * (post_title, post_image, post_content, post_author) are filled. If all fields
 * are filled, it inserts a new post into the 'posts' table with the current timestamp.
 * 
 * @global mysqli $conn The MySQLi connection object.
 * 
 * @param string $_POST['submit'] The form submission trigger.
 * @param string $_POST['post_title'] The title of the post.
 * @param string $_POST['post_image'] The image associated with the post.
 * @param string $_POST['post_content'] The content of the post.
 * @param string $_POST['post_author'] The author of the post.
 * 
 * @return void
 */
if (isset($_POST['submit'])) {
    if (!empty($_POST['post_title']) && !empty($_POST['post_image']) && !empty($_POST['post_content']) && !empty($_POST['post_author'])) {
        $post_title = $_POST['post_title'];
        $post_image = $_POST['post_image'];
        $post_content = $_POST['post_content'];
        $post_author = $_POST['post_author'];

        $sql = "INSERT INTO posts (post_title, post_image, post_content, post_author, post_published) 
                    VALUES ('$post_title', '$post_image', '$post_content', '$post_author', NOW())";

        if ($conn->query($sql) === TRUE) {
            $status = "<p>Post was created successfully</p>";
        } else {
            $status = "<p>An error occurred, post was not created</p>";
        }
    } else {
        $status = "<p>All fields are required</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <h1 class="page-title">Mini CMS | Create Blog Post</h1>
            <p>In this section, you can create blog posts</p>

            <form action="post-create.php" method="post">
                <div class="form-item">
                    <label for="post-title" class="label">Post Title:</label>
                    <div class="field">
                        <input name="post_title" type="text" id="post-title" required>
                    </div>
                </div>
                <div class="form-item">
                    <label for="post-image" class="label">Post Image:</label>
                    <div class="field">
                        <input name="post_image" type="text" id="post-image" required>
                    </div>
                </div>
                <div class="form-item">
                    <label for="post-content" class="label">Post Content:</label>
                    <div class="field">
                        <textarea name="post_content" id="post-content" rows="5" required></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <label for="post-author" class="label">Post Author (ID):</label>
                    <div class="field">
                        <input name="post_author" type="number" id="post-author" required>
                    </div>
                </div>
                <button type="submit" name="submit">Create Post</button>
            </form>

            <?php echo $status; ?>
        </main>
    </div>
</body>

</html>