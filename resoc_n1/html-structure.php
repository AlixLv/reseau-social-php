 <article>
    <h3>
        <time><?php echo $post['created'] ?></time>
    </h3>
    <address><?php echo "<a href='wall.php?user_id=" . $post['user_id'] . "'>Par " .  $post['author_name'] . "</a>" ?></address>
    <div>
        <p><?php echo $post['content'] ?></p>
    </div>                                            
    <footer>
        <?php
            include "like.php";
        ?>
        <form action="like.php" method="post">
            <button type="submit" name="like"><?php echo "♥ " . $post['like_number'] ?></button>
        </form>
        <?php 
        $tags = explode(',', $post['taglist']);
        foreach ($tags as $tag) {
            echo "<a href=''> " . $tag . "</a>";
        } ?>
    </footer>
</article> 