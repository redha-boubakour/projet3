        <?php include("header.php"); ?>
        
        <form action="connecte.php" method="post">
            <p><input type="text" name="compte" placeholder="Votre compte"></p>
            <p><input type="password" name="mdp" placeholder="Votre mot de passe"></p>
            <p><button type="submit" name="connexion">Se connecter</button></p>
        </form>

        <form action="index.php" method="post">
            <p><button type="submit" name="deconnexion">Se déconnecter</button></p>
        </form>
        
        <?php include("footer.php"); ?>