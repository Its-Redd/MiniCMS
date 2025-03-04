<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./admin/includes/connection.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="page-homepage">
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
            <section class="page-hero">
                <h1 class="page-hero-title">Mini CMS</h1>
            </section>
            <div class="inner-wrapper">
                <h1 class="page-title">Latest Posts</h1>
                <div class="posts">
                    <?php
                    $sql = "SELECT * FROM posts ORDER BY post_published DESC LIMIT 5";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_object()) {
                        $sql1 = "SELECT * FROM users WHERE Id = $row->post_author";
                        $result1 = $conn->query($sql1);
                        $author = $result1->fetch_object();
                    ?>
                        <article class="post">
                            <div class="post-image" style="background-image: url('./img/<?php echo trim($row->post_image) ?>');"></div>
                            <div class="post-text">
                                <div class="post-title"><?php echo $row->post_title ?></div>
                                <div class="post-author"><?php echo "By {$author->Firstname} {$author->Lastname}  " ?> | <?php echo $row->post_published ?></div>
                                <a href="post.php?post_id=<?php echo $row->Id ?>" class="post-btn">Read more</a>
                            </div>
                        </article>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</body>