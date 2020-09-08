<?php

if(isset($_POST['submit']))
{

try
    {
	    $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $checkaccount = htmlspecialchars($_POST['email']);
    $checkanswer = htmlspecialchars($_POST['answer']);

    if(!empty($checkaccount)) 
    {
        $requser =  $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requser->execute(array($checkaccount));
        $userinfo = $requser->fetch();

        if(!empty($userinfo))
        {
            if($checkaccount == $userinfo['email'])
            {
                $_SESSION['email'] = $userinfo['email'];
                $_SESSION['question'] = $userinfo['question'];
                
                if(!empty($checkanswer))
                {
                    if(isset($checkanswer) AND $checkanswer == $userinfo['answer'])
                    {             
                        $_SESSION['password'] = $userinfo['password'];
                        header('Location: nouveaumotdepasse.php');   
                        exit();
                    }
                    else
                    {
                        $error = "Mauvaise réponse.";
                    }
                }
                else
                {
                    $error = "le champ doit être complété.";
                }
            }
        }
        else
        {
        $error = "Compte inexistant.";
        }
    }
    else
    {
    $error = "le champ doit être complété.";
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
            <h1 class="title">Mot de passe oublié ?</h1>
            <p>Veuillez rentrer votre adresse mail</p>
            <form method="post" class="form">
                <input class="inputs" type="text" name="email" placeholder="Votre adresse mail" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>">

                <?php if(isset($_SESSION['email'])) { ?>

                <p><?php echo $_SESSION['question']; ?></p>
                <input class="inputs" type="text" name="answer" placeholder="Votre réponse">

                <?php } ?>

                <button type="submit" class="button" name="submit">Valider</button>
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