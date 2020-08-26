<?php
try
{
$bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('INSERT INTO comptes (compte_nom, compte_mail, compte_mdp) VALUES(?, ?, ?)');
$req->execute(array($_POST['nouveau_compte'], $_POST['nouveau_mail'], $_POST['nouveau_mdp']));

echo 'Compte ajouté !';
?>