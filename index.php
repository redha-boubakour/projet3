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

// Vérification de la validité des informations

if(isset($_POST['connect']))
{
    $loginconnect = htmlspecialchars($_POST['login']);
    $passconnect = $_POST['pass'];

    if(!empty($loginconnect) AND !empty($passconnect)) 
    {
        $requser =  $bdd->prepare('SELECT * FROM user WHERE username = ?');
        $requser->execute(array($loginconnect));
        $userinfo = $requser->fetch();
        
        if (!empty($userinfo))
        {
            if (password_verify($passconnect, $userinfo['password'])) {
                $_SESSION['username'] = $userinfo['username'];
                $_SESSION['email'] = $userinfo['email'];
                $_SESSION['firstname'] = $userinfo['firstname'];
                $_SESSION['lastname'] = $userinfo['lastname'];
                $_SESSION['question'] = $userinfo['question'];
                $_SESSION['answer'] = $userinfo['answer'];
                header('Location: connecte.php');
                exit();
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
            <?php if (isset($_SESSION['account_created'])) {echo $_SESSION['account_created'];} ?>
            <h1 class="title">Connexion</h1>
            <form method="post" class="form">
                <input class="inputs" id="login" name="login" type="text" placeholder="Votre compte">
                <input class="inputs" id="pass" name="pass" type="password" placeholder="Votre mot de passe">
                <button type="submit" class="button" name="connect">Se connecter</button>
            </form> 
            
            <?php
                if(isset($error))
                {
                    echo $error;
                }
            ?>

            <p class="other_page" id="forgot"><a href="motdepasseoublie.php">Mot de passe oublié ?</p>
            <p class="other_page"><a href="inscription.php">Créer un compte</p>
        </div>
    </body>
</html>