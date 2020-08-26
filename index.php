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
            <p class="title">Connexion</p>
            <form method="post" class="form">
                <input class="inputs" id="login" name="login" type="text" placeholder="Votre compte">
                <input class="inputs" id="pass" name="pass" type="password" placeholder="Votre mot de passe">
                <button class="button" name="connexion">Se connecter</button>
                <p class="other_page" id="forgot"><a href="#">Mot de passe oublié ?</p>
                <p class="other_page"><a href="inscription.php">Creer un compte</p>
            </form>            
        </div>
    </body>
</html>