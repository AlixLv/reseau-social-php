<?php 
    include '../resoc_n1/database-connection.php';
        
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


    $postEnCours = isset($_POST['content']);

    if ($postEnCours){

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

    header("Location: ./wall.php?user_id=" . $id);
    }
 
?>






 
