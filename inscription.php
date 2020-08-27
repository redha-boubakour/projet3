<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="style.css"/>
        <link
            href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
            rel="stylesheet"
        />
        <title>GBAF</title>
    </head>
    <body>
        <img class="logo_index" src="./images/logo.png" alt="logo">
        <div class="main">
            <p class="title">Creer un compte</p>
            <form method="post">
                <p><input class="inputs" type="text" name="new_account" id="new_account" placeholder="Votre compte"></p>
                <p><input class="inputs" type="text" name="new_email" id="new_email" placeholder="Votre mail"></p>

                <p><?= (!empty($_POST) && empty($_POST['new_email'])) ?  "l'adresse email est vide" : '' ?></p>
                <p><?= isset($errors['new_email']) ? $errors ['new_email'] : '' ?></p>

                <p><input class="inputs" type="password" name="new_pass" id="new_pass" placeholder="Votre mot de passe"></>
                <p><input class="inputs" type="password" name="new_pass_conf"    id="new_pass_conf" placeholder="Confirmer votre mot de passe"></p>
                <p><input class="inputs" type="text" name="secret_question" id="secret_question" placeholder="Question secrète"></p>
                <p><input class="inputs" type="text" name="secret_response" id="secret_response" placeholder="Réponse secrète"></p>

                <button type="submit" class="button" name="registration">S'inscrire</button>
            </form>
            <p class="other_page"><a href="index.php">Se connecter</p>
        </div>
    </body>
</html>