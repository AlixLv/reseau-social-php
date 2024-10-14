<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php 
        include '../resoc_n1/main/header.php';
        ?>

        <?php

        include '../resoc_n1/main/main-utilities.php';
        ?>
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
          
                $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
                include 'query-response.php';

                while ($tag = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo "#" . $tag['label'] ?></h3>
                        <p><?php echo "id: " . $tag['id'] ?></p>
                        <nav>
                            <a href=<?php echo "tags.php?tag_id=" . $tag['id'] ?>>Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                
                while ($tag = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo $tag['alias'] ?></h3>
                        <p><?php echo $tag['id'] ?></p>
                        <nav>
                            <a href=<?php echo "wall.php?user_id=" . $tag['id'] ?>>Mur</a>
                            | <a href=<?php echo "feed.php?user_id=" . $tag['id'] ?>>Flux</a>
                            | <a href=<?php echo "settings.php?user_id=" . $tag['id'] ?>>Paramètres</a>
                            | <a href=<?php echo "followers.php?user_id=" . $tag['id'] ?>>Suiveurs</a>
                            | <a href=<?php echo "subscriptions.php?user_id=" . $tag['id'] ?>>Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
