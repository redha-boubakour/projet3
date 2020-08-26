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
                <p><input class="inputs" type="text" name="nouveau_compte" id="nouveau_compte" placeholder="Votre compte"></p>
                <p><input class="inputs" type="text" name="nouveau_mail" id="nouveau_mail" placeholder="Votre mail"></p>

                <p><?= (!empty($_POST) && empty($_POST['nouveau_mail'])) ?  "l'adresse email est vide" : '' ?></p>
                <p><?= isset($errors['nouveau_mail']) ? $errors ['nouveau_mail'] : '' ?></p>

                <p><input class="inputs" type="password"    name="nouveau_mdp" id="nouveau_mdp" placeholder="Votre mot de passe"></>
                <p><input class="inputs" type="password"    name="nouveau_mdp_confirmation"    id="nouveau_mdp_confirmation" placeholder="Confirmer votre mot de passe"></p>
                <button class="button" name="inscription">S'inscrire</button>
            </form>
            <p class="other_page"><a href="index.php">Se connecter</p>
        </div>
    </body>
</html>