<?php 
function getTagsId($tagId){
    return "SELECT * FROM tags WHERE id= '$tagId' ";
} 


// A MODIFIER POUR COMPTER LES LIKES ???
function getPostsByTag($tag){
    return "SELECT
    posts.content,
    posts.created,
    posts.id AS post_id,
    users.alias AS author_name,
    COUNT(distinct likes.id) AS like_number,
    users.id AS user_id,
    GROUP_CONCAT(DISTINCT tags.label) AS taglist,
    GROUP_CONCAT(DISTINCT tags.id) AS tagsId 
    FROM posts_tags AS filter
    JOIN posts ON posts.id = filter.post_id
    JOIN users ON users.id = posts.user_id
    LEFT JOIN posts_tags AS pt ON posts.id = pt.post_id
    LEFT JOIN tags ON pt.tag_id = tags.id
    LEFT JOIN likes ON likes.post_id = posts.id
    WHERE filter.tag_id = $tag
    GROUP BY posts.id, posts.content, posts.created, users.alias, users.id
    ORDER BY posts.created DESC;";
}


?>