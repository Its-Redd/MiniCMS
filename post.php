<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./admin/includes/connection.php";

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $sql = "SELECT * FROM posts WHERE Id = $post_id";
    $result = $conn->query($sql);
    $post = $result->fetch_object();

    $sql1 = "SELECT * FROM users WHERE Id = $post->post_author";
    $result1 = $conn->query($sql1);
    $author = $result1->fetch_object();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="page-post">
    <div class="page-wrapper">
        <header class="page-header">
            <nav class="main-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="posts.php">Posts</a></li>
                    <li><a href="login.php">Log in</a></li>
                </ul>
            </nav>
        </header>
        <div class="page-content-wrapper">
            <div class="inner-wrapper">
                <main class="page-content">
                    <article class="post">
                        <div class="post-text">
                            <div class="post-title"><?php echo $post->post_title ?></div>
                            <div class="post-author"><?php echo "By {$author->Firstname} {$author->Lastname}  " ?> | <?php echo $post->post_published; ?></div>
                            <div class="post-content"><?php echo $post->post_content ?></div>
                        </div>
                    </article>
                </main>


            </div>
        </div>

    </div>
</body>

</html>