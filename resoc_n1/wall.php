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
    <?php 
        include '../resoc_n1/database-connection.php';
        
        $listTags = [];
        $laQuestionEnSql = "SELECT * FROM tags";
        include '../resoc_n1/query-response.php';
        while ($tag = $lesInformations->fetch_assoc())
        {
            $listTags[$tag['id']] = $tag['label'];
        }

    $postEnCours = isset($_POST['content']);
    // if ($postEnCours){


    //     $lInstructionSql = "INSERT INTO posts"
    //     . "(id, user_id, content, created)"
    //     . "VALUES (NULL, "
    // }
    ?>

        <div id="new_post">
            <form action="login.php" method="post">
                <dl>
                    <!-- pré-remplir chanmps prénom -->
                    <dt><label for='name'>Prénom: </label></dt>
                    <dd><input type='text'name='name'></dd>
                    <dt><label for='content'>Message: </label></dt>
                    <dd><input type='textarea'name='content'></dd>
                    <dt><label for='tag'>Tags: </label></dt>
                    <dd><select name='tag'>
                        <?php
                            foreach ($listTags as $id => $label)
                                echo "<option value='$id'>$label</option>";
                        ?>
                    </select></dd>
                </dl>
            </form>    
        </div>

        <div id="wrapper">
            <?php
            
            $userId =intval($_GET['user_id']);
            ?>
            <?php
            include 'database-connection.php';
            ?>

            <aside>
                <?php
               
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();

                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message de l'utilisatrice : <?php echo $user['alias'] ?>
                        (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <?php
                var_dump($_POST);
                $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    users.id as user_id,
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
                include 'query-response.php';

                while ($post = $lesInformations->fetch_assoc())
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
