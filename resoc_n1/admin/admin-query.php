<?php
function getTagsQuery() {
    return "SELECT * FROM `tags` LIMIT 50";
}

function getUsersQuery() {
    return "SELECT * FROM `users` LIMIT 50";
}

?>