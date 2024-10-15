<?php 
include './admin-controller.php';
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>

        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php


                while ($tag = $tagsData->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo "#" . $tag['label'] ?></h3>
                        <p><?php echo "id: " . $tag['id'] ?></p>
                        <nav>
                            <a href=<?php echo "../tags/tags-display.php?tag_id=" . $tag['id'] ?>>Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                
                while ($tag = $usersData->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo $tag['alias'] ?></h3>
                        <p><?php echo $tag['id'] ?></p>
                        <nav>
                            <a href=<?php echo "../wall/wall-display.php?user_id=" . $tag['id'] ?>>Mur</a>
                            | <a href=<?php echo "../feed/feed-display.php?user_id=" . $tag['id'] ?>>Flux</a>
                            | <a href=<?php echo "../settings/settings-display.php?user_id=" . $tag['id'] ?>>Paramètres</a>
                            | <a href=<?php echo "../followers/followers-display.php?user_id=" . $tag['id'] ?>>Suiveurs</a>
                            | <a href=<?php echo "../subscriptions/subscriptions-display.php?user_id=" . $tag['id'] ?>>Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
