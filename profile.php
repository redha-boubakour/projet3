<?php 
session_start();

if (isset($_SESSION['username']))
{

    require 'sql.php';

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