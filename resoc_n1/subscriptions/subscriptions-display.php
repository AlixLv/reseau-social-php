<?php
include './subscriptions-controller.php';
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <aside>
                <img src="../images/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?>
                        suit les messages
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                    
                        while ($subscriber = $followingData->fetch_assoc())
                        {
                            echo "<article>";
                            echo "<img src='../images/user.jpg' alt='blason'/>";
                            echo "<h3>" . $subscriber['alias'] . "</h3>";
                            echo "<p>Id: " . $subscriber['id'] . "</p>";            
                            echo "</article>";
                        }
                ?>
            </main>
        </div>
    </body>
</html>
