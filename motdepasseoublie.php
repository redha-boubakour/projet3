<?php
session_start();
if(isset($_POST['submit']))
{

require 'sql.php';

    $checkaccount = htmlspecialchars($_POST['email']);

    if(!empty($checkaccount)) 
    {
        $requser = $bdd->prepare('SELECT * FROM user WHERE email = ?');
        $requser->execute(array($checkaccount));
        $userinfo = $requser->fetch();

        if(!empty($userinfo))
        {
            if($checkaccount == $userinfo['email'])
            {
                $_SESSION['email'] = $userinfo['email'];
                $_SESSION['question'] = $userinfo['question'];

                if(isset($_POST['answer']))
                {
                    $checkanswer = htmlspecialchars($_POST['answer']);

                    if(!empty($checkanswer))
                    {
                        if(isset($checkanswer) AND $checkanswer == $userinfo['answer'])
                        {             
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

            <?php if(isset($error)) : ?>
                <div class="error"><p><?= $error ?></p></div>
            <?php endif; ?>

            <form method="post" class="form">
                <input class="inputs" type="text" name="email" placeholder="Votre adresse mail" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>">

                <?php if(isset($_SESSION['email'])) : ?>

                <p>Veuillez répondre à la question suivante : </p>
                <p><?= $_SESSION['question']; ?></p>
                <input class="inputs" type="text" name="answer" placeholder="Votre réponse">

                <?php endif; ?>

                <button type="submit" class="button" name="submit">Valider</button>
            </form> 

            <p class="other_page"><a href="index.php">Se connecter</p>
        </div>
    </body>
</html>