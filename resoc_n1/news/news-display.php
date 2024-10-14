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
                while ($postDataRendering = $postDataAnswer->fetch_assoc())
                {
                
                    ?>
                    <?php 
                    
                        // $newsPost = renderPost();
                        ?>
                    <?php
                }
                ?>

            </main>
        </div>
    </body>
</html>
