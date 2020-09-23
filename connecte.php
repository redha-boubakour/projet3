<?php 
session_start();

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{
    require 'sql.php';

    $actorsinfo = getActors();
?>

<?php include("header.php"); ?>

<section class="main_2">
    <h1 class="title">Presentation du GBAF</h1>
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

    <img src="./images/illustration1.jpg" id="illustration1" alt="illustration">
</section>

<section class="main_2" >
    <h1 class="title">Les partenaires</h1>
    <p> Les produits et services bancaires sont nombreux et très variés. Afin de renseigner au mieux les clients, les salariés des 340 agences des banques et assurances en France (agents, chargés de clientèle, conseillers financiers, etc.) recherchent sur Internet des informations portant sur des produits bancaires et des financeurs, entre autres. Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires. Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes français un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers. Chaque salarié pourra ainsi poster un commentaire et donner son avis.</p>

    <?php
    foreach ($actorsinfo as $actorinfo) :
        $id = $actorinfo['id'];

        if (strlen($actorinfo['content']) > 100)
        {
            $extract = substr($actorinfo['content'], 0, 100)."...";
    ?>

    <div class="partenaire">
        <img class="logo_partenaire" src="<?php echo $actorinfo['logo']; ?>"  alt="logo"/>
        <h3 class="nom_partenaire"><?php echo htmlspecialchars($actorinfo['name']); ?></h3>
        <div class="contenu_partenaire"><?php echo htmlspecialchars($extract); ?></div>
        <div class="lireLaSuite_partenaire"><button class="button" onclick="window.location.href='pageacteur.php?id=<?php echo $id; ?>'">Lire la suite</button></div>
    </div>

    <?php
        }
    endforeach;
    ?>
</section>

<?php
}
?>

<?php include("footer.php"); ?>