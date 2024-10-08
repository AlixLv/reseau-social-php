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
    // var_dump($_SESSION);
    if ($postEnCours){
// récupérer l'id du user dont c'est la session en cours 
    $prenom = $post['author_name'];
    var_dump($prenom);

    $post_content = $_POST['content'];

    // $post_tag = 

// insérer les données dans la table post
    $insererPostDansTable = "INSERT INTO posts
    (id, user_id, content, created)
    VALUES (NULL, " . $userId .", " . $post_content .", NOW())"; 
        echo "🍏 " . $insererPostDansTable; 
    }

 // insérer le tag dans la table tag
// afficher le nouveau message sur le mur    
?>






 
