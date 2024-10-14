<?php 

function getUserName($request, $id) {
    $userInfo = $request->query("SELECT * FROM users WHERE id= '$id' ");
    $userName = $userInfo->fetch_assoc()['alias'];
    return $userName;
}

function getPostData($author_id) {
    return "SELECT posts.content, posts.created, users.alias as author_name, 
            users.id as user_id,
            posts.id as post_id,
            COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
            FROM posts
            JOIN users ON  users.id=posts.user_id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
            LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
            LEFT JOIN likes      ON likes.post_id  = posts.id 
            WHERE posts.user_id='$author_id' 
            GROUP BY posts.id
            ORDER BY posts.created DESC";
}

?>