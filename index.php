<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="normalize.css"/>
        <link rel="stylesheet" href="style.css"/>
        <title>GBAF</title>
    </head>
    <body>
        <img class="logo_index" src="./images/logo.png" alt="logo">
        <div class="main">
            <h1 class="title">Connexion</h1>
            <form action="connecte.php" method="post" class="form">
                <input class="inputs" id="login" name="login" type="text" placeholder="Votre compte">
                <input class="inputs" id="pass" name="pass" type="password" placeholder="Votre mot de passe">
                <button type="submit" class="button" name="connect">Se connecter</button>
            </form> 
            <p class="other_page" id="forgot"><a href="#">Mot de passe oublié ?</p>
            <p class="other_page"><a href="inscription.php">Créer un compte</p>
        </div>
    </body>
</html>