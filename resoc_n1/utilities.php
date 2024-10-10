<?php

function dataBaseConnexion(){
    $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
        if ($mysqli->connect_errno)
        {
            echo "<article>";
            echo("Échec de la connexion : " . $mysqli->connect_error);
            echo("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
            echo "</article>";
            exit();
        }
    return $mysqli;
}


function checkFollower($followedUser, $followingUser) {
    $mysqli = dataBaseConnexion();

    $checkQuery = $mysqli->query("SELECT * FROM followers
    WHERE following_user_id =" . $followingUser . "
    AND followed_user_id =" . $followedUser);

    if ($checkQuery->num_rows==0) {
        return false;
    } else {
        return true;
    }
}

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

function insertPost(){
    $mysqli = dataBaseConnexion();
    $id = $_GET['user_id'];

    $post_content = $_POST['content'];

    $insererPostDansTable = "INSERT INTO posts
    (id, user_id, content, created)
    VALUES (NULL, " . $id .", '" . $post_content ."', NOW())";
    
    $mysqli->query($insererPostDansTable);
    
    $myId = $mysqli->insert_id;
    
    $selectedTag = $_POST['tag'];

    $myInsertPostTagQuery = "INSERT INTO posts_tags
    (id, post_id, tag_id)
    VALUES (NULL, " . $myId . ", ". $selectedTag .")";

    $mysqli->query($myInsertPostTagQuery);
}

function getTags() {
    $mysqli = dataBaseConnexion();
    $listTags = [];
    $laQueryEnSQL = "SELECT * FROM tags";
    $laReponseEnSQL = $mysqli->query($laQueryEnSQL);
  
    if ( ! $laReponseEnSQL)
    {
        echo("Échec de la requete : " . $mysqli->error);
        exit();
    }
    while ($tag = $laReponseEnSQL->fetch_assoc())
    {
        $listTags[$tag['id']] = $tag['label'];
    }
    return $listTags;
}

function isLoggedIn() {
    return isset($_SESSION["connected_id"]) ? true : false;
}

?>