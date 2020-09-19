<?php
session_start();

require 'sql.php';

// Vérification de la validité des informations

if(isset($_POST['connect']))
{
    $loginconnect = htmlspecialchars($_POST['login']);
    $passconnect = $_POST['pass'];

    if(!empty($loginconnect) AND !empty($passconnect)) 
    {
        $userinfo = getUser($loginconnect);
        
        if ($userinfo['username'])
        {
            if (password_verify($passconnect, $userinfo['password'])) {
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['username'] = $userinfo['username'];
                $_SESSION['email'] = $userinfo['email'];
                $_SESSION['firstname'] = $userinfo['firstname'];
                $_SESSION['lastname'] = $userinfo['lastname'];
                $_SESSION['question'] = $userinfo['question'];
                $_SESSION['answer'] = $userinfo['answer'];
                header('Location: connecte.php');
                exit();
            }
            else
            {
                $error = "Compte inexistant ou mot de passe incorrect.";
            }
        }
        else
        {
            $error = "Compte inexistant ou mot de passe incorrect.";
        }
    }
    else
    {
        $error = "tout les champs doivent être complétés.";
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
            <h1 class="title">Connexion</h1>

            <?php if(isset($error)) : ?>
                <div class="error"><p><?= $error ?></p></div>
            <?php endif; ?>

            <form method="post" class="form">
                <input class="inputs" id="login" name="login" type="text" placeholder="Votre compte">
                <input class="inputs" id="pass" name="pass" type="password" placeholder="Votre mot de passe">
                <button type="submit" class="button" name="connect">Se connecter</button>
            </form> 

            <p class="other_page"><a href="motdepasseoublie.php">Mot de passe oublié ?</p>
            <p class="other_page"><a href="inscription.php">Créer un compte</p>
        </div>
    </body>
</html>