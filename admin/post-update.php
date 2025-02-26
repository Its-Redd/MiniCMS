<?php
  session_start();
    session_start();
    require_once "includes/connection.php";

    if(!isset($_SESSION['user_id'])){
        header('Location: ../login.php');
     }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function FindPost($conn, $post_id) {
        $sql = "SELECT * FROM posts WHERE Id = $post_id";
        return $conn->query($sql);
    }

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