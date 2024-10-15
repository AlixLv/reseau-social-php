<?php 
    include '../main/header.php';
    include '../main/main-utilities.php';
    include 'tags-queries.php';
    $tagId = intval($_GET['tag_id']);
    $mysqli = dataBaseConnexion();
    $connected_id = $_SESSION['connected_id'];
    $end_url = getUrl($_SERVER['REQUEST_URI']);

?>