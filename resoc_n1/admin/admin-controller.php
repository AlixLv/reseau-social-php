<?php 
        include '../main/header.php';
        include '../main/main-utilities.php';
        include './admin-query.php';

        $mysqli = dataBaseConnexion();
        $tagsData = getQueryResponse(getTagsQuery(), $mysqli);
        $usersData = getQueryResponse(getUsersQuery(), $mysqli);               
?>