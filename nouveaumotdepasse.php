<?php  
session_start();

try
        {
	        $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
        }
            catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

if(isset($_POST['modify']))
{
    $pass_hache = $_POST['new_password'];
    $pass_hache_conf = $_POST['new_password_conf'];
    $email = $_SESSION['email'];

    if(!empty($_POST['new_password']) AND !empty($_POST['new_password_conf']))
    {
        if($pass_hache == $pass_hache_conf)
        {
            $pass_hache = password_hash($pass_hache, PASSWORD_BCRYPT);
            $req = $bdd->prepare("
                        UPDATE user
                        SET password = '$pass_hache'
                        WHERE email = '$email'
                    ");
            $req->execute();

            $_SESSION['password_modified'] = "Votre mot de passe a été modifié.";
            header('Location: index.php');
            exit();
        }
        else
        {
            $error = "Vos Mots de passe ne correspondent pas.";
        }
    }
    else
    {
        $error = 'Tous les champs doivent être complétés.';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="./css/normalize.css"/>
        <link rel="stylesheet" href="./css/style.css"/>
        <title>GBAF</title>
    </head>
    <body>
        <img class="logo_index" src="./images/logo.png" alt="logo">
        <div class="main">
            <h1 class="title">Changment de mot de passe</h1>
            <form method="post" class="form">
                <p><input class="inputs" type="password" name="new_password" placeholder="Votre nouveau mot de passe"></p>
                <p><input class="inputs" type="password" name="new_password_conf" placeholder="Confirmer votre nouveau mot de passe"></p>
                <button type="submit" class="button" name="modify">Modifier votre mot de passe</button>
            </form> 
            
            <?php
                if(isset($error))
                {
                    echo $error;
                }
            ?>
            
            <p class="other_page"><a href="index.php">Se connecter</p>
        </div>
    </body>
</html>