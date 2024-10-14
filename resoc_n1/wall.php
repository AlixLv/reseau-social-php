<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
    <?php 
        // fonction à bouger dans "wall queries" avant de push   
        function getUserName($request, $id) {
            $userInfo = $request->query("SELECT * FROM users WHERE id= '$id' ");
            $userName = $userInfo->fetch_assoc()['alias'];
            return $userName;
        }

        function getPostData($author_id) {
            return "SELECT posts.content, posts.created, users.alias as author_name, 
                    users.id as user_id,
                    posts.id as post_id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$author_id' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC";
        }
        //

        include '../resoc_n1/main/header.php';
        include '../resoc_n1/main/main-utilities.php';
        include '../resoc_n1/wall-queries.php';
        
        //déclaration des variables globales (à mettre dans un fichier 'Controller')
        $mysqli = dataBaseConnexion();
        $connected_id = $_SESSION['connected_id'];
        $userId =intval($_GET['user_id']);
        $end_url = getUrl($_SERVER['HTTPS'], $_SERVER['REQUEST_URI']);
        $wall_user_id = getUserName($mysqli, $userId);


        //Monitoring des requêtes POST en cours
        
        //Bouton "Like"
        $likedPost = $_POST['post_id'] ;
        $likeInProgress = isset($_POST['like']);
        if ($likeInProgress) {
            likePost($likedPost, $connected_id, $mysqli);
        }

        //Bouton "Follow"
        $followInProgress = isset($_POST['follow']);
        if ($followInProgress) {
            follow($mysqli, $userId, $connected_id);
        } 

        //Bouton "Nouveau post"
        $postInProgress = isset($_POST['content']);
        if ($postInProgress){
            insertPost();
            header("Location: ./wall.php?user_id=" . $userId);
        }
        
        //Récupération des informations des posts de l'utilisateur
        $postData = getQueryResponse(getPostData($userId), $mysqli);
    ?>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $wall_user_id ?>
                        (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <div id="new_post">
                  <form action='./<?php echo $end_url ?>' method='post'>
                      <dl>  
                            <dt><label for='content'>Message: </label></dt>
                            <dd><input type='textarea'name='content'></dd>
                            <dt><label for='tag'>Tags: </label></dt>
                            <dd><select name='tag'>
                            <?php
                                //Menu déroulant "Tags"
                                $listTagsReady = getTags();
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
                    <form action='./<?php echo $end_url ?>' method='post'>
                        <button type="submit" name="follow">
                            <?php 
                            //Génération du bouton "Follow"/"Unfollow"
                            if (checkFollower($userId, $connected_id)) {
                                echo "Unfollow";
                            } else {
                                echo "Follow";
                            }
                            ?>
                        </button>
                    </form>
                </div>
                <?php while ($post = $postData->fetch_assoc())
                { ?>                
                    <?php 
                    //Génération des posts de l'utilisateur
                    renderPost($post, $end_url);
                    ?>
                <?php } ?>
            </main>
        </div>
    </body>
</html>