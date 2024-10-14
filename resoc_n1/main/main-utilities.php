<?php
session_start();

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

function isLoggedIn($session_id) {
    return isset($session_id) ? true : false;
}

function getQueryResponse($sqlQuery, $mysqli) {
    $response = $mysqli->query($sqlQuery);
    if ( ! $response)
    {
        echo("Échec de la requete : " . $mysqli->error);
        exit();
    }
    return $response;
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

function renderPost($postInfo, $targetUrl) {

    echo "<article>";
    echo "    <h3>";
    echo "        <time>" . $postInfo['created'] . "</time>";
    echo "    </h3>";
    echo "    <address><a href='wall.php?user_id=" . $postInfo['user_id'] . "'>Par " . $postInfo['author_name'] . "</a></address>";
    echo "    <div><p>" . $postInfo['content'] . "</p></div>";
    echo "    <footer>";
    echo "        <form action='./" . $targetUrl . "' method='post'>";
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

function follow($db_connexion, $wall_id, $session_id) {
    if (!checkFollower($wall_id, $session_id)) {
         $followQuery = $db_connexion->query("INSERT INTO followers
        (id, followed_user_id, following_user_id)
        VALUES (NULL, " . $wall_id . ", ". $session_id . ")");
    } else {
        $unfollowQuery = $db_connexion->query("DELETE FROM followers
        WHERE followed_user_id = " . $wall_id . "
        AND following_user_id = " . $session_id);
    }
}


function likePost($post_id, $session_id, $db_connexion) {

    $checkedIfLikedQuery = $db_connexion->query("SELECT * FROM likes
    WHERE user_id =" . $session_id . "
    AND post_id =" . $post_id);

    if ($checkedIfLikedQuery->num_rows == 0) {
        $db_connexion->query("INSERT INTO likes
        (id, user_id, post_id)
        VALUES (NULL, " . $session_id . ", ". $post_id .")");
    } else {
        $db_connexion->query("DELETE FROM likes
        WHERE user_id = " . $session_id . " 
        AND post_id = ". $post_id);
    }
}

function getUrl($https, $request) {
    $url = (empty($https) ? 'http' : 'https') . "://$request";
    $cropped_url = end(explode('/', $url));
    return $cropped_url;
}
?>