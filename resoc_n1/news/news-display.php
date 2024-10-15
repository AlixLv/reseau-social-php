<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
    <?php 
        include '../main/header.php';
        include_once '../main/main-utilities.php';
        
        $mysqli = dataBaseConnexion();
        $end_url = getUrl($_SERVER['REQUEST_URI']);
        $connected_id = $_SESSION['connected_id'];

//Monitoring des requêtes POST en cours
//Bouton "Like"
    $likeInProgress = isset($_POST['like']);
    if ($likeInProgress) {
        $likedPost = $_POST['post_id'] ;
        likePost($likedPost, $connected_id, $mysqli);
    } 
        
    ?>
        <div id="wrapper">
            <aside>
                <img src="../images/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages de
                        tous les utilisatrices du site.</p>
                </section>
            </aside>
            <main>
                <?php
                include 'news-query.php';
                $postDataAnswer = getPostData($mysqli);

                while ($postDataRendering = $postDataAnswer->fetch_assoc())
                {
                
                    ?>
                    <?php 
                        renderPost($postDataRendering, $end_url);
                        ?>
                    <?php
                }
                ?>

            </main>
        </div>
    </body>
</html>
