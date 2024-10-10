<?php 

function renderPost($postInfo) {
    
    echo "<article>";
    echo "    <h3>";
    echo "        <time>" . $postInfo['created'] . "</time>";
    echo "    </h3>";
    echo "    <address><a href='wall.php?user_id=" . $postInfo['user_id'] . "'>Par " . $postInfo['author_name'] . "</a></address>";
    echo "    <div><p>" . $postInfo['content'] . "</p></div>";
    echo "    <footer>";
    echo "        <form action='like.php' method='post'>";
    if (isset($_GET["user_id"])) {
        echo "            <input type='hidden' name='wall_user_id' value='" . $_GET['user_id'] . "'>";
    }
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[REQUEST_URI]";
    // var_dump($actual_link); // Commented out to avoid output
    echo "            <input type='hidden' name='post_id' value='" . $postInfo['post_id'] . "'>";
    echo "            <button type='submit' name='like'>" . "♥ " . $postInfo['like_number'] . "</button>";
    echo "        </form>";
    $tags = explode(',', $postInfo['taglist']);
    foreach ($tags as $tag) {
        echo "<a href=''>" . $tag . "</a>";
    }
    echo "    </footer>";
    echo "</article>";

}

?>