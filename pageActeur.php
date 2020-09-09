<?php 
session_start();

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'])
{

    try
    {
	    $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
    }
        catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    print_r($_SESSION['id']);

    if(isset($_SESSION['id']))
    {
        $req = $bdd->query("SELECT * FROM actor WHERE id = '{$_SESSION[ "id" ]}'");

?>

    <?php include("header.php"); ?>

    <?php
        while($actorinfo = $req->fetch())
        {
    ?>

    <section class="main_2">
        <section class="fiche_partenaire">
            <div class="logo_partenaire"><?php echo htmlspecialchars($actorinfo['logo']); ?></div>
            <h3 class="nom_partenaire"><?php echo htmlspecialchars($actorinfo['name']); ?></h3>
            <div class="contenu_partenaire"><?php echo htmlspecialchars($actorinfo['content']); ?></div>
        </section>

        <section class="commentairesActeur">
            
            <div class="tableau_de_bord">
                <div class="nombre_total_commentaires_acteur">
                    X Commentaires
                </div>
                <div class="creation_commentaire">
                    Nouveau commentaire
                </div>
                <div class="evaluation">
                    Evaluation globale
                </div>
            </div>

            <div class="commentaire_acteur">
                <div class="commentaire">
                    <ul>
                        <li>Nom</li>
                        <li>Date</li>
                        <li>Commentaire</li>
                    </ul>
                </div>
            </div>
        </section>
    </section>

    <?php
        }
    }
    else
    {
        echo "It is not set.";
    }
}

    ?>

        <?php include("footer.php"); ?>