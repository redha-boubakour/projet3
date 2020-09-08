<?php 
session_start();

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'])
{

try
    {
	    $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
    }
        catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

?>

<?php include("header.php"); ?>

<section class="main_2" id="presentation">
    <h1 id="intro_gbaf">
    <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération représentant les 6 grands groupes français :
    </p>
    <ul>
        <li>BNP Paribas ;</li>
        <li>BPCE ;</li>
        <li>Crédit Agricole ;</li>
        <li>Crédit Mutuel-CIC ;</li>
        <li>Société Générale ;</li>
        <li>La Banque Postale.</li>
    </ul>
    <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
    </h1>
    <img src="./images/illustration1.jpg" id="illustration1" alt="illustration">
</section>

<section id="partenaires">
    <h2>
    Les produits et services bancaires sont nombreux et très variés. Afin de renseigner au mieux les clients, les salariés des 340 agences des banques et assurances en France (agents, chargés de clientèle, conseillers financiers, etc.) recherchent sur Internet des informations portant sur des produits bancaires et des financeurs, entre autres. Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires. Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes français un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers. Chaque salarié pourra ainsi poster un commentaire et donner son avis.
    </h2>
    <div class="partenaire">
        <div class="logo_partenaire"><img src="./images/cde.png" alt="logo du partenaire"></div>
        <h3 class="nom_partenaire">CDE</h3>
        <div class="contenu_partenaire">La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation..</div>
        <div class="lireLaSuite_partenaire"><button class="button" onclick="window.location.href='pageActeur.php';">Lire la suite</button></div>
    </div>
    <div class="partenaire">
        <div class="logo_partenaire"><img src="./images/dsa_france.png" alt="logo du partenaire"></div>
        <h3 class="nom_partenaire">DSA France</h3>
        <div class="contenu_partenaire">DSA France accélère la croissance du territoire et s’engage avec..</div>
        <div class="lireLaSuite_partenaire"><button class="button" onclick="window.location.href='pageActeur.php';">Lire la suite</button></div>
    </div>
    <div class="partenaire">
        <div class="logo_partenaire"><img src="./images/formation_co.png" alt="logo du partenaire"></div>
        <h3 class="nom_partenaire">Formation&co</h3>
        <div class="contenu_partenaire">Formation&co est une association française présente sur tout le territoire...</div>
        <div class="lireLaSuite_partenaire"><button class="button" onclick="window.location.href='pageActeur.php';">Lire la suite</button></div>
    </div>
    <div class="partenaire">
        <div class="logo_partenaire"><img src="./images/protectpeople.png" alt="logo du partenaire"></div>
        <h3 class="nom_partenaire">Protectpeople</h3>
        <div class="contenu_partenaire">Protectpeople finance la solidarité nationale. Nous appliquons le principe..</div>
        <div class="lireLaSuite_partenaire"><button class="button" onclick="window.location.href='pageActeur.php';">Lire la suite</button></div>
    </div>
</section>

<?php
    }
?>

<?php include("footer.php"); ?>