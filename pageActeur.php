<?php 
session_start();

/* Verification de l'existance des variables SESSION */
if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{
    require 'sql.php';

    /* Verification de l existance des acteurs et preparation de la table actor */
    if(isset($_GET['id']))
    {
        $actorinfo = getActor();
    }
    else
    {
        echo "Acteur inconnu";
    }

    /* création  de commentaire */
    if(isset($_POST['submit_comment_btn']))
    {
        if(!empty($_POST['insert_comment']))
        {
            $insert_comment = htmlspecialchars($_POST['insert_comment']);
            $date = new Datetime();
            $created_at = $date->format('Y-m-d h:i:s');
            $actor_id = $_GET['id'];
            $login_id = $_SESSION['id'];

            addComment($insert_comment, $created_at, $actor_id, $login_id);
            header('Location: pageacteur.php?id='.$actor_id);
            exit();
        }
        else
        {
            $error = 'La zone de commentaire doit être remplie.';
        }
    }

    /* la jointure entre les deux tables : comment & user */
    $commentsinfo = joinCommentUserById();

    /* le total des commentaires - acteur */
    $count = getTotalCommentsByActor();

    /* Partie systeme de votes */
    if(isset($_POST['positive-btn']) OR isset($_POST['negative-btn']))
    {            
        $actor_id = $_GET['id'];
        $login_id = $_SESSION['id'];
        $positive_vote = 1;
        $negative_vote = 0;

        if(isset($_POST['positive-btn']))
        {
            addPositiveVote($positive_vote, $actor_id, $login_id);
            updatePositiveVoteForActor();
            header('Location: pageacteur.php?id='.$actorinfo['id']);
        }
        elseif (isset($_POST['negative-btn']))
        {
            addNegativeVote($negative_vote, $actor_id, $login_id);
            updateNegativeVoteForActor();
            header('Location: pageacteur.php?id='.$actorinfo['id']);
        }
    }

    /* preparation de la table vote */
    $voteinfo = getVote();

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
            <div class="total_comments"><?php echo $count ?> Commentaire(s)</div>
            <br>
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
                <textarea class="big_inputs" type="text" name="insert_comment" placeholder="Veuillez entrer votre commentaire.." cols="30" rows="10"></textarea>
                <button type="submit" class="button" name="submit_comment_btn">Valider</button>
            </form>

            <?php if(isset($error)) : ?>
                <div class="error"><p><?= $error ?></p></div>
            <?php endif; ?>
        </div>

        <?php
        foreach ($commentsinfo as $commentinfo) :
            if($_GET['id'] == $commentinfo['actor_id']) 
            {
                $comment_date = new \Datetime($commentinfo['created_at']);
                $comment_date->setTimeZone(new \DateTimeZone('Europe/Paris'));
        ?>

        <div class="comments">
            <h2 class="name_login"><?php echo htmlspecialchars($commentinfo['username']); ?></h2>
            <div class="comment_content"><?php echo htmlspecialchars($commentinfo['content']); ?></div>
            <div class="created_at"><?php echo htmlspecialchars($comment_date->format('d-m-Y H:i:s')); ?></div>
        </div>

        <?php
            }
            endforeach;
        ?>
    </section>
</section>

<?php
}
?>

<?php include("footer.php"); ?>