<?php 
session_start();

/* Verification de l'existance des variables SESSION */

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{

    require 'sql.php';

    /* Verification de l existance des acteurs */

    if(isset($_GET['id']))
    {
        $req = $bdd->query("SELECT * FROM actor WHERE id = '{$_GET[ "id" ]}'");
        $actorinfo = $req->fetch();
    }
    else
    {
        echo "Acteur inconnu";
    }

    /* Partie création commentaire */
    
    if(isset($_POST['submit_comment_btn']))
    {
        if(!empty($_POST['insert_comment']))
        {
            $insert_comment = htmlspecialchars($_POST['insert_comment']);
            $date = new Datetime();
            $created_at = $date->format('Y-m-d h:i:s');
            $actor_id = $_GET['id'];
            $login_id = $_SESSION['id'];

            $add_comment = $bdd->prepare('
                INSERT INTO comment(content, created_at, actor_id, login_id)
                VALUES(:content, :created_at, :actor_id, :login_id)
            ');
            $add_comment->execute(array(
                'content' => $insert_comment,
                'created_at' => $created_at,
                'actor_id' => $actor_id,
                'login_id' => $login_id
            ));
            header('Location: pageActeur.php?id='.$actor_id);
            $_SESSION['comment_created'] = "Votre commentaire a été rajouté.";
        }
        else
        {
            $error = 'La zone de commentaire doit être remplie.';
        }
    }

    $req2 = $bdd->query('SELECT * FROM comment ORDER BY created_at DESC');

    /* le total des commentaires - acteur */

    $req3 = $bdd->query("SELECT * FROM comment WHERE actor_id = '{$_GET[ "id" ]}'");
    $count = $req3->rowCount();

    /* Partie systeme de votes */

    if(isset($_POST['positive-btn']) OR isset($_POST['negative-btn']))
    {            
        $actor_id = $_GET['id'];
        $login_id = $_SESSION['id'];

        $add_vote = $bdd->prepare('
            INSERT INTO vote(vote, actor_id, login_id)
            VALUES(:vote, :actor_id, :login_id)
        ');

        if(isset($_POST['positive-btn']))
        {
            $add_vote->execute(array(
                'vote' => 1,
                'actor_id' => $actor_id,
                'login_id' => $login_id
            ));
            
            $req5 = $bdd->prepare("
                UPDATE actor
                SET positive_vote = positive_vote + 1
                WHERE id = '{$_GET[ "id" ]}'
            ");
            $req5->execute();

            header('Location: pageActeur.php?id='.$actorinfo['id']);
        }
        elseif (isset($_POST['negative-btn']))
        {
            $add_vote->execute(array(
                'vote' => 0,
                'actor_id' => $actor_id,
                'login_id' => $login_id
            ));

            $req5 = $bdd->prepare("
                UPDATE actor
                SET negative_vote = negative_vote + 1
                WHERE id = '{$_GET[ "id" ]}'
            ");
            $req5->execute();

            header('Location: pageActeur.php?id='.$actorinfo['id']);
        }
    }

    $req6 = $bdd->query("SELECT * FROM vote WHERE (login_id = '{$_SESSION['id']}' AND actor_id = '{$_GET[ "id" ]}')");
    $voteinfo = $req6->fetch();

?>

<?php include("header.php"); ?>

<section class="main_2">
    <section class="fiche_partenaire">
        <img src="<?php echo $actorinfo['logo']; ?>" class="logo_partenaire" alt="logo"/>
        <h3 class="nom_partenaire"><?php echo htmlspecialchars($actorinfo['name']); ?></h3>
        <div class="contenu_partenaire"><?php echo htmlspecialchars($actorinfo['content']); ?></div>
    </section>

    <section class="comment_section">
            
        <div class="tableau_de_bord">
            <div class="total_comments"><?php echo $count ?> Commentaires</div>
            <div class="evaluation">
                <form method="post" class="form">
                    <?php echo $actorinfo['positive_vote']; ?>
                    <button name="positive-btn" id="positive-btn"
                        <?php 
                        if($voteinfo['login_id'] == $_SESSION['id'] AND !is_null($voteinfo['vote']))
                        { 
                            echo ' Disabled'; 
                        } 
                        ?>
                    ><img src="./images/thumbs-up.png"></button>
                    <?php echo $actorinfo['negative_vote']; ?>
                    <button name="negative-btn" id="negative-btn"
                        <?php 
                        if(isset($voteinfo['login_id']) AND !is_null($voteinfo['vote']))
                        { 
                            echo ' Disabled'; 
                        } 
                        ?>
                    ><img src="./images/thumbs-down.png"></button>
                </form>
            </div>
        </div>

        <div class="new_comment">
            <form method="post" class="form">
                <textarea class="big_inputs" type="text" name="insert_comment" placeholder="Entrer votre commentaire.." cols="30" rows="10"></textarea>
                <button type="submit" class="button" name="submit_comment_btn">Valider</button>
            </form>

            <?php
            if(isset($error))
            {
                echo $error;
            }
            ?>

        </div>

    <?php
        while ($commentinfo = $req2->fetch())
        {
            if($_GET['id'] == $commentinfo['actor_id']) 
            {
    ?>

        <div class="comments">
            <h2 class="name_login"><?php echo htmlspecialchars($commentinfo['login_id']); ?></h2>
            <div class="comment_content"><?php echo htmlspecialchars($commentinfo['content']); ?></div>
            <div class="created_at"><?php echo htmlspecialchars($commentinfo['created_at']); ?></div>
        </div>

    <?php
            }
        }
    ?>

    </section>
</section>

<?php
}
?>

<?php include("footer.php"); ?>