<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnés </title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <?php 
        include '../resoc_n1/main/header.php';
    ?>
        <div id="wrapper">          
            <aside>
                <img src = "user.jpg" alt = "Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes qui
                        suivent les messages de l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?></p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                $userId = intval($_GET['user_id']);
                include '../resoc_n1/main/main-utilities.php';
                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
                include 'query-response.php';
                
                while ($subscriber = $lesInformations->fetch_assoc())
                {
                ?>
                <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3><?php echo $subscriber['alias'] ?></h3>
                    <p><?php echo "Id: " . $subscriber['id'] ?></p>
                </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
