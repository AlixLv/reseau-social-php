<?php 
include 'feed-controller.php'; 
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <aside>
            <img src="../images/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message des utilisatrices
                        auxquel est abonnée l'utilisatrice <?php echo $user['alias'] ?>
                        (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <?php
                while ($post = $feedPosts->fetch_assoc())
                {
                    renderPost($post, $end_url);
                } 
                ?>
            </main>
        </div>
    </body>
</html>
