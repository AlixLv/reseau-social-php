 <article>
    <h3>
        <time><?php echo $post['created'] ?></time>
    </h3>
    <address><?php echo "Par " . $post['author_name'] ?></address>
    <div>
        <p><?php echo $post['content'] ?></p>
    </div>                                            
    <footer>
        <small><?php echo "♥ " . $post['like_number'] ?></small>
        <?php 
        $tags = explode(',', $post['taglist']);
        foreach ($tags as $tag) {
            echo "<a href=''> " . $tag . "</a>";
        } ?>
    </footer>
</article> 