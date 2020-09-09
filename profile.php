<?php 
session_start();

if (isset($_SESSION['username']))
{

    try
    {
	    $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
    }
        catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

?>

<?php include("header.php"); ?>

<div class="main">
    <h1 class="title">Profil</h1>
    <p>Nom du compte : <?php echo $_SESSION['username']; ?></p>
    <p>Adresse mail : <?php echo $_SESSION['email']; ?></p>
    <p>Nom : <?php echo $_SESSION['firstname']; ?></p>
    <p>Prénom : <?php echo $_SESSION['lastname']; ?></p>
    <p>Question secrète : <?php echo $_SESSION['question']; ?></p>
    <p>Réponse secrète : <?php echo $_SESSION['answer']; ?></p>
</div>

<?php
}
?>

<?php include("footer.php"); ?>