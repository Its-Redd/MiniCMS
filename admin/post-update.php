<?php
session_start();
require_once "includes/connection.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}


function FindPost($conn, $post_id)
{
    $sql = "SELECT * FROM posts WHERE Id = $post_id";
    return $conn->query($sql);
}

/**
 * This script handles the retrieval of a post for updating in the MiniCMS admin panel.
 * 
 * - If the 'Id' parameter is present in the GET request, it retrieves the post ID from the GET request,
 *   stores it in the session, and fetches the post details from the database.
 * - If the 'Id' parameter is not present in the GET request, it retrieves the post ID from the session
 *   and fetches the post details from the database.
 * 
 * @param mysqli $conn The MySQLi connection object.
 * @param int $post_id The ID of the post to be retrieved.
 * @return object $row The fetched post details as an object.
 */
if (isset($_GET['Id'])) {
    $post_id = $_GET['Id'];
    $_SESSION['post_id'] = $post_id;
    $result = FindPost($conn, $post_id);
    $row = $result->fetch_object();
} else {
    $post_id = $_SESSION['post_id'];
    $result = FindPost($conn, $post_id);
    $row = $result->fetch_object();
}

$status = "";

/**
 * Updates a post in the database with the provided data from a POST request.
 *
 * This script expects the following POST parameters:
 * - 'submit': A flag to indicate the form was submitted.
 * - 'post_title': The title of the post.
 * - 'post_image': The image associated with the post.
 * - 'post_content': The content of the post.
 * - 'post_author': The author of the post.
 *
 * The script performs the following actions:
 * 1. Retrieves the POST parameters.
 * 2. Constructs and executes an SQL UPDATE query to update the post in the database.
 * 3. Fetches the updated post data.
 * 4. Sets a status message indicating whether the update was successful or not.
 *
 * @global mysqli $conn The database connection object.
 * @param int $post_id The ID of the post to be updated.
 * @return void
 */
if (isset($_POST['submit'])) {
    $post_title = $_POST['post_title'];
    $post_image = $_POST['post_image'];
    $post_content = $_POST['post_content'];
    $post_author = $_POST['post_author'];

    $sql = "UPDATE posts SET
            post_title = '{$post_title}',
            post_image = '{$post_image}',
            post_content = '{$post_content}',
            post_author = '{$post_author}'
            WHERE Id = '{$post_id}'";

    $result = $conn->query($sql);

    $updated = FindPost($conn, $post_id);
    $row = $updated->fetch_object();

    if ($result) {
        $status = "Post was updated successfully";
    } else {
        $status = "An error occurred, post was not updated";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog Post</title>
    <link rel="stylesheet" href="/admin/css/style.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="page-header">
            <?php include "includes/admin_menu.php"; ?>
        </header>
        <main class="page-content">
            <div class="inner-wrapper-narrow">
                <h1 class="page-title">Mini CMS | Update Blog Post</h1>
                <p>Submit the form to update the blog post</p>

                <form action="post-update.php" method="post">
                    <div class="form-item">
                        <label for="post-title" class="label">Post Title:</label>
                        <div class="field">
                            <input name="post_title" type="text" id="post-title" value="<?php echo htmlspecialchars(trim($row->post_title)); ?>" required>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="post-image" class="label">Post Image:</label>
                        <div class="field">
                            <input name="post_image" type="text" id="post-image" value="<?php echo htmlspecialchars(trim($row->post_image)); ?>" required>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="post-content" class="label">Post Content:</label>
                        <div class="field">
                            <textarea name="post_content" id="post-content" rows="5" required><?php echo htmlspecialchars(trim($row->post_content)); ?></textarea>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="post-author" class="label">Post Author (ID):</label>
                        <div class="field">
                            <input name="post_author" type="number" id="post-author" value="<?php echo htmlspecialchars(trim($row->post_author)); ?>" required>
                        </div>
                    </div>
                    <button type="submit" name="submit">Update Post</button>
                </form>
                <h2><?php echo $status; ?></h2>
            </div>
        </main>
    </div>
</body>

</html>