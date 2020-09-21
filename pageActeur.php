<?php 
session_start();

/* Verification de l'existance des variables SESSION */
if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{
    require 'sql.php';

    $actorId = (int)$_GET['id'];
    $loginId = $_SESSION['id'];

    /* Verification de l existance des acteurs et preparation de la table actor */
    if(isset($actorId))
    {
        $actorinfo = getActor($actorId);

        if(!$actorinfo)
        {
            header('Location: connecte.php');
            exit();
        }
    } 
    else 
    {
        header('Location: connecte.php');
        exit();
    }

    /* création  de commentaire */
    if(isset($_POST['submit_comment_btn']))
    {
        if(!empty($_POST['insert_comment']))
        {
            $insert_comment = htmlspecialchars($_POST['insert_comment']);
            $date = new Datetime();
            $created_at = $date->format('Y-m-d h:i:s');

            addComment($insert_comment, $created_at, $actorId, $loginId);
            header('Location: pageacteur.php?id='.$actorId);
            exit();
        }
        else
        {
            $error = 'La zone de commentaire doit être remplie.';
        }
    }

    /* la jointure entre les deux tables : comment & user */
    $commentsinfo = getCommentUserById();

    /* le total des commentaires - acteur */
    $count = getTotalCommentsByActor($actorId);

    /* Partie systeme de votes */
    if(isset($_POST['positive-btn']) OR isset($_POST['negative-btn']))
    {            
        $positive_vote = 1;
        $negative_vote = 0;

        if(isset($_POST['positive-btn']))
        {
            addPositiveVote($positive_vote, $actorId, $loginId);
            header('Location: pageacteur.php?id='.$actorinfo['id']);
            exit();
        }
        elseif (isset($_POST['negative-btn']))
        {
            addNegativeVote($negative_vote, $actorId, $loginId);
            header('Location: pageacteur.php?id='.$actorinfo['id']);
            exit();
        }
    }

    /* preparation de la table vote */
    $voteinfo = getVote($loginId, $actorId);
    $votesPositive = getVotesByActorId($actorId, '1');
    $votesNegative = getVotesByActorId($actorId, '0');

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
            <p class="total_comments"><?php echo $count ?> Commentaire(s)</p><br>

            <?php 
                if(is_null($voteinfo['vote']))
                { 
            ?>

            <div class="evaluation">
                <form method="post" class="form">
                    <?php echo $votesPositive; ?>
                    <button name="positive-btn" id="positive-btn"><img src="./images/thumbs-up.png"></button>
                    <?php echo $votesNegative; ?>
                    <button name="negative-btn" id="negative-btn"><img src="./images/thumbs-down.png"></button>
                </form>
            </div>

            <?php
                } else { 
            ?>

            <div class="evaluation">
                <?php echo $votesPositive; ?>
                <img src="./images/thumbs-up.png" alt="Pouce positif">
                <?php echo $votesNegative; ?>
                <img src="./images/thumbs-down.png" alt="Pouce négatif">
            </div>

            <?php
                }
            ?>
        </div>

        <div class="new_comment">
            <form method="post" class="form" id="new_comment_form">
                <textarea class="big_inputs" name="insert_comment" placeholder="Veuillez entrer votre commentaire.." cols="30" rows="10"></textarea>
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