<?php 
function getUserIdInfos($userId) {
    return "SELECT * FROM `users` WHERE id= '$userId'";
}

function getFeedPosts($userId) {
    return "SELECT posts.content,
                    posts.created,
                    posts.id as post_id,
                    users.alias as author_name,  
                    count(likes.id) as like_number, 
                    users.id as user_id,
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id) AS tagsId 
                    FROM followers 
                    JOIN users ON users.id=followers.followed_user_id
                    JOIN posts ON posts.user_id=users.id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE followers.following_user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC";
}


?>