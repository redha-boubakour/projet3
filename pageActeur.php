<?php 
session_start();

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{

    try
    {
	    $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
    }
        catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    if(isset($_GET['id']))
    {
        $req = $bdd->query("SELECT * FROM actor WHERE id = '{$_GET[ "id" ]}'");
        $actorinfo = $req->fetch();
    }
    else
    {
        echo "Acteur inconnu";
    }

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

    $req = $bdd->query('SELECT * FROM comment ORDER BY created_at DESC');

    $req2 = $bdd->query("SELECT * FROM comment WHERE actor_id = '{$_GET[ "id" ]}'");
    $count = $req2->rowCount();

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
            <div class="total_comment"><?php echo $count ?> Commentaires</div>
            <div class="evaluation">
                Evaluation globale
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
        while ($commentinfo = $req->fetch())
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