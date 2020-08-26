        <?php 
        session_start(); 
    
        $_SESSION['compte'] = 'compte_test';
        $_SESSION['mdp'] = 'mdp_test';
        ?>
        
        <?php include("header.php"); ?>

        <h1>Bonjour, <?php echo $_COOKIE['cookie_test'];?></h1>

        <section class="fiche_partenaire">
            <div class="logo_partenaire"><img src="./images/" alt="logo du partenaire"></div>
            <h3 class="nom_partenaire">Nom du partenaire</h3>
            <div class="contenu_partenaire">Contenu du partenaire</div>
        </section>

        <section class="commentairesActeur">
            
            <div class="tableau_de_bord">
                <div class="nombre_total_commentaires_acteur">
                    X Commentaires
                </div>
                <div class="creation_commentaire">
                    Nouveau commentaire
                </div>
                <div class="evaluation">
                    Evaluation globale
                </div>
            </div>

            <div class="commentaire_acteur">
                <div class="commentaire">
                    <ul>
                        <li>Nom</li>
                        <li>Date</li>
                        <li>Commentaire</li>
                    </ul>
                </div>
            </div>
        </section>

        <?php include("footer.php"); ?>