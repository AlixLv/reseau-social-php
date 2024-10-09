 <article>
    <h3>
        
        <time><?php echo $post['created'] ?></time>
    </h3>
    <address><?php echo "<a href='wall.php?user_id=" . $post['user_id'] . "'>Par " .  $post['author_name'] . "</a>" ?></address>
    <div>
        <p><?php echo $post['content'] ?></p>
    </div>                                            
    <footer>
        <form action="like.php" method="post">
            <?php 
            if (isset($_GET["user_id"])) {
                echo "<input type='hidden' name='wall_user_id' value=" . $_GET['user_id'] . ">";
            }
            ?>

            <!-- split url -->
            <?php 
            $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[REQUEST_URI]"; 
            var_dump($actual_link);
            ?>


            <input type="hidden" name="post_id" value="<?php echo $post['post_id'] ?>">
            <button type="submit" name="like"><?php echo "♥ " . $post['like_number'] ?></button>
        </form>
        <?php 
        $tags = explode(',', $post['taglist']);
        foreach ($tags as $tag) {
            echo "<a href=''> " . $tag . "</a>";
        } ?>
    </footer>
</article> 