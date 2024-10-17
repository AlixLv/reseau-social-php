<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Les messages par mot-clé</title> 
        <meta name="authors" content="Anne Kaftal, Alix Levé, William Petitpierre, Moussa Traoré">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <?php
            include 'tags-controller.php';    
            $tagsId = $mysqli->query(getTagsId($tagId));
            $tag = $tagsId->fetch_assoc();
        
    //Monitoring des requêtes POST en cours
    //Bouton "Like"
       
        $likeInProgress = isset($_POST['like']);
        if ($likeInProgress) {
            $likedPost = $_POST['post_id'] ;
            likePost($likedPost, $connected_id, $mysqli);
        }
        ?>
        <div id="wrapper">

            <aside>

                <img src="../images/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages comportant
                        le mot-clé <?php echo $tag['label'] ?>
                        (n° <?php echo $tagId ?>)
                    </p>

                </section>
            </aside>
            <main>
                <?php
                $tagsData = $mysqli->query(getPostsByTag($tagId));
                
                
                while ($gettingTagsData = $tagsData->fetch_assoc())
                {
                    ?>  
                    <?php 
                    var_dump($gettingTagsData['like_number']);             
                       renderPost($gettingTagsData, $end_url);
                      ?>
                <?php } ?>
            </main>
        </div>
    </body>
</html>