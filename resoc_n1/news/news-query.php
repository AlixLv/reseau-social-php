<?php
    include '../main/main-utilities.php';
    $mysqli = dataBaseConnexion();

    function getPostData($mysqli){
    $getPostDataQuery = "
    SELECT posts.content,
    posts.created,
    posts.id as post_id,
    users.alias as author_name,  
    count(likes.id) as like_number,  
    users.id as user_id,
    GROUP_CONCAT(DISTINCT tags.label) AS taglist 
    FROM posts
    JOIN users ON  users.id=posts.user_id
    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
    LEFT JOIN likes      ON likes.post_id  = posts.id 
    GROUP BY posts.id
    ORDER BY posts.created DESC  
    LIMIT 5
    ";
  
    return $postDataAnswer = $mysqli->query($getPostDataQuery);
    }
?>