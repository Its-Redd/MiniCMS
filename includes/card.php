<article class="post">
  <div class="post-image">
    <img src="<?php
    
      echo $var->post_image;
    
    ?>" alt="Alt">
  </div>
  <div class="post-text">
    <div class="post-title">
        <?php
            echo "<p>$var->post_title</p>";
        ?>
    </div>
    <div class="post-author">
        <?php
            $sql1 = "SELECT Firstname, Lastname FROM users WHERE Id = $var->post_author";
            // echo "<script>console.log(`$var->post_author`);</script>";

            echo "<script>console.log(`$result1`);</script>";
            echo "<p>$author->$author</p>";
        ?>
    </div>                                                           
    <a href="url/to/post" class="post-btn">Read more</a>                             
  </div>
</article>

<?php

    

?>