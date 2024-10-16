<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mur</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
    <?php 

        include 'wall-controller.php';

        //Monitoring des requêtes POST en cours
        //Bouton "Like"
       
        $likeInProgress = isset($_POST['like']);
        if ($likeInProgress) {
            $likedPost = $_POST['post_id'] ;
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
            var_dump($_POST);
            insertPost();
            header("Location: $end_url");
        }
        
        //Récupération des informations des posts de l'utilisateur
        $postData = getQueryResponse(getPostData($userId), $mysqli);
    ?>
        <div id="wrapper">
            <aside>
                <img src="../images/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $wall_user_id ?>
                        (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <div class="newpost">
                  <form action='./<?php echo $end_url ?>' method='post'>
                      <dl class="creatingpost">  
                            <dt><label for='content'>Message: </label></dt>
                            <dd><input type='textarea'name='content'></dd>
                            <dt><label for='tag'">Tags: </label></dt>
                            <dd><select name='tag'>
                            <?php
                                //Menu déroulant "Tags"
                                $listTagsReady = getTags();
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
                            if (checkFollower($userId, $connected_id, $mysqli)) {
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