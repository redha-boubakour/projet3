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
        <header>
            <img onclick="window.location.href='connecte.php'" src="./images/logo.png" class="logo" id="header-img" alt="logo"/>
            <nav class="nav_bar" id="nav_bar">
                <ul class="menu">
                    <li><a href="connecte.php" class="nav_link"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></a>
                        <ul class="sub_menu">
                            <li><a href="profile.php">profil</a></li>
                            <li><a href="deconnexion.php">Se déconnecter</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>