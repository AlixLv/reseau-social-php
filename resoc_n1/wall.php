<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <?php 
        include 'header.php';
    ?>
        <div id="wrapper">
            <?php
            
            $userId =intval($_GET['user_id']);
            ?>
            <?php
            include '../resoc_n1/utilities.php';
            $mysqli = dataBaseConnexion();
            ?>
    
            <?php
               
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();

            ?>

            <?php
                // var_dump($_POST);
                $getPostDataQuery = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    users.id as user_id,
                    posts.id as post_id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                 
                    $postData = $mysqli->query($getPostDataQuery);
                    if ( ! $postData)
                    {
                        echo("Échec de la requete : " . $mysqli->error);
                        exit();
                    }
                
                 ?>
                
                <?php 
                include "wall-post.php";
                // include "wall-follow.php";
                ?>

            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $user['alias'] ?>
                        (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <div id="new_post">
                  <form action="wall-post.php?user_id=<?php echo $userId ?>"  method="post">
                      <dl>  
                            <dt><label for='content'>Message: </label></dt>
                            <dd><input type='textarea'name='content'></dd>
                            <dt><label for='tag'>Tags: </label></dt>
                            <dd><select name='tag'>
                
                            <?php
                                $listTagsReady = getTags();
                                echo('coucou');
                                var_dump($listTagsReady);
                                foreach ($listTagsReady as $id => $label)
                                    echo "<option value='$id'>$label</option>";
                            ?>
                            </select></dd>
                        </dl>
                        <input type='submit'>
                     </form>    
                </div>
                <div id="follow">
                    <form action="wall-follow.php?user_id=<?php echo $userId ?>" method="post">
                        <button type="submit" name="follow">
                            <?php 
                            if (checkFollower($userId, $_SESSION['connected_id'])) {
                                echo "Unfollow";
                            } else {
                                echo "Follow";
                            }
                            ?>
                        </button>
                    </form>
                </div>
                <?php while ($post = $postData->fetch_assoc())
                {

                    ?>                
                        <?php 
                        include 'html-structure.php'
                        ?>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
