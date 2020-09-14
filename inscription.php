<?php  

require 'sql.php';

// Vérification de la validité des informations

if(isset($_POST['registration']))
{
    $new_username = htmlspecialchars($_POST['new_username']);
    $new_email = htmlspecialchars($_POST['new_email']);
    $pass_hache = $_POST['new_password'];
    $pass_hache_conf = $_POST['new_password_conf'];
    $new_question = htmlspecialchars($_POST['new_question']);
    $new_answer = htmlspecialchars($_POST['new_answer']);
    $new_firstname = htmlspecialchars($_POST['new_firstname']);
    $new_lastname = htmlspecialchars($_POST['new_lastname']);

    if(!empty($_POST['new_username']) AND !empty($_POST['new_email']) AND !empty($_POST['new_password']) AND !empty($_POST['new_password_conf']) AND !empty($_POST['new_question']) AND !empty($_POST['new_answer']) AND !empty($_POST['new_firstname']) AND !empty($_POST['new_lastname']))
    {
        if(filter_var($new_email, FILTER_VALIDATE_EMAIL))
        {
            $existingemail = getUserIfExist($new_email);

            if($existingemail == 0)
            {
                if($pass_hache == $pass_hache_conf)
                {
                    $pass_hache = password_hash($pass_hache, PASSWORD_BCRYPT);
                    $date = new Datetime();
                    $created_at = $date->format('Y-m-d h:i:s');
                    $req = $bdd->prepare('
                        INSERT INTO user(username, email, password, question, answer, firstname, lastname, created_at)
                        VALUES(:username, :email, :password, :question, :answer, :firstname, :lastname, :created_at)
                    ');
                    $req->execute(array(
                        'username' => $new_username,
                        'email' => $new_email,
                        'password' => $pass_hache,
                        'question' => $new_question,
                        'answer' => $new_answer,
                        'firstname' => $new_firstname,
                        'lastname' => $new_lastname,
                        'created_at' => $created_at
                    ));
                    $_SESSION['account_created'] = "Votre compte à été crée.";
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
                $error = "Adresse mail déjà utilisée.";
            }
        }
        else
        {
            $error = "Votre adresse mail n'est pas valide.";
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
            <p class="title">Creer un compte</p>
            <form method="post">
                <input class="inputs" type="text" name="new_username" value="<?php if(isset($new_username)) { echo $new_username; } ?>" placeholder="Votre compte">
                <input class="inputs" type="text" name="new_email" value="<?php if(isset($new_email)) { echo $new_email; } ?>" placeholder="Votre mail">
                <input class="inputs" type="password" name="new_password" placeholder="Votre mot de passe">
                <input class="inputs" type="password" name="new_password_conf" placeholder="Confirmer votre mot de passe">
                <input class="inputs" type="text" name="new_firstname" value="<?php if(isset($new_firstname)) { echo $new_firstname; } ?>" placeholder="Votre nom">
                <input class="inputs" type="text" name="new_lastname" value="<?php if(isset($new_lastname)) { echo $new_lastname; } ?>" placeholder="Votre prénom">
                <input class="inputs" type="text" name="new_question" value="<?php if(isset($new_question)) { echo $new_question; } ?>" placeholder="Question secrète">
                <input class="inputs" type="text" name="new_answer" value="<?php if(isset($new_answer)) { echo $new_answer; } ?>" placeholder="Réponse secrète">

                <button type="submit" class="button" name="registration">S'inscrire</button>
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