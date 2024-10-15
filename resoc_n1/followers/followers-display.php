<?php
include './followers-controller.php';
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper">          
            <aside>
                <img src = "../images/user.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                while ($subscriber = $followersData->fetch_assoc())
                {
                ?>
                <article>
                    <img src="../images/user.jpg" alt="blason"/>
                    <h3><?php echo $subscriber['alias'] ?></h3>
                    <p><?php echo "Id: " . $subscriber['id'] ?></p>
                </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
