<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <?php 
        include '../resoc_n1/main/header.php';
    ?>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
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
                    include '../resoc_n1/utilities.php';
                    // session_destroy();
                    if (isLoggedIn()) {
                
                        $userId = intval($_GET['user_id']); 
                        $laQuestionEnSql = "
                            SELECT users.* 
                            FROM followers 
                            LEFT JOIN users ON users.id=followers.followed_user_id 
                            WHERE followers.following_user_id='$userId'
                            GROUP BY users.id
                            ";
                        include 'query-response.php';
                        while ($subscriber = $lesInformations->fetch_assoc())
                        {
                            echo "<article>";
                            echo "<img src='user.jpg' alt='blason'/>";
                            echo "<h3>" . $subscriber['alias'] . "</h3>";
                            echo "<p>Id: " . $subscriber['id'] . "</p>";            
                            echo "</article>";
                        }
                    } 
                    else {
                        header("Location: ../resoc_n2/login.php");
                    }
                ?>


            </main>
        </div>
    </body>
</html>
