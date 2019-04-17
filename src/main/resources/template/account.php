<?php 
include_once '../../function/functions.php';
loggedOnly();
include_once './include/menu.php';
?>
        <h2 class="text-center">Mon compte</h2>
        <h5 class="text-center">Bonjour  <?= $_SESSION['auth']->nomUtilisateur; ?></h5>

                <div class="container">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <form method="POST" action="#">
                <button class="btn btn-primary" type="submit" name="afficherArticle">Afficher mes articles</button>
                <button class="btn btn-primary" type="submit" name="fermerArticle">Fermer l'affichage des articles</button>
                </form>
                </ol>
                </nav>

                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="ajouterArticle.php">Crée un article</a></li>
                </ol>
                </nav>

                <?php
require_once '../../function/db.php'; // Require la connexion a la base de donnée

$idUtilisateur = $_SESSION['auth']->idUtilisateur;
// Afficher mes articles //
if(isset($_POST['afficherArticle']) && ([$_POST['fermerArticle']])) {
$article = $pdo->prepare('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article WHERE idUtilisateur = :idUtilisateur');
$article->bindParam(':idUtilisateur', $idUtilisateur);
$article->execute();

while ($donnees = $article->fetch())
{          
?>
<div class="news">
<h3>
<?php echo htmlspecialchars($donnees->titreArticle); ?>
<em> posté le <?php echo $donnees->dateCreationFr ?></em>
</h3>

<p>
<?php
// On affiche le contenu du billet
echo nl2br(htmlspecialchars($donnees->contenuArticle));
?>
<p><a href="modifierMonArticle.php?idArticle=<?php echo $donnees->idArticle ?>">Modifier cette article</a></p>
</div>
<
<?php
}} // Fin de la boucle des billets
        
$statut = $_SESSION['auth']->statut;
if($_SESSION['auth'] && $statut == "admin") {

?>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="admin.php">Aller sur la page admin</a></li>
        </ol>
        </nav>
        </div>
<?php

}