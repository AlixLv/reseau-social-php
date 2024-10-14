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
        include '../main/main-utilities.php';
        
        $mysqli = dataBaseConnexion();
        $end_url = getUrl($_SERVER['HTTPS'], $_SERVER['REQUEST_URI']);
        
    ?>
        <div id="wrapper">
            <aside>
                <img src="../user.jpg" alt="Portrait de l'utilisatrice"/>
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
                var_dump($postDataAnswer);
                while ($postDataRendering = $postDataAnswer->fetch_assoc())
                {
                
                    ?>
                    <?php 
                        echo "coucou";
                        $newsPost = renderPost($postDataRendering, $end_url);
                        var_dump($newsPost);
                        ?>
                    <?php
                }
                ?>

            </main>
        </div>
    </body>
</html>
