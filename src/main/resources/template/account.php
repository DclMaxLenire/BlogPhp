<?php 
include_once '../../function/functions.php';
loggedOnly();
include_once './include/menu.php';
?>
        <h2 class="text-center">Mon compte</h2>
        <h5 class="text-center">Bonjour  <?= $_SESSION['auth']->nomUtilisateur; ?></h5>

                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <form method="POST" action="#">
                <div class="form-group">
                <button class="btn btn-primary mb-3" type="submit" name="afficherArticle">Afficher mes articles</button>
                <button class="btn btn-primary" type="submit" name="fermerArticle">Fermer l'affichage des articles</button>
                </form>
                </ol>
                </div>
                </nav>

                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="ajouterArticle.php">Crée un article</a></li>
                </ol>
                </nav>
<?php
                $statut = $_SESSION['auth']->statutUtilisateur;
if($_SESSION['auth'] && $statut == 1) {

?>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="admin.php">Aller sur la page admin</a></li>
        </ol>
        </nav>
        </div>
<?php

}

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
<div class="card col-12 col-sm-12 col-md-8 col-lg-8 radius-10 m-auto">
<div class="card-body">
    <h5 class="card-title">
        <?php echo htmlspecialchars($donnees->titreArticle); ?>
    </h5>
    <p class="card-text">Posté par <b><?php echo $donnees->auteur ?></b></p>
    <p class="card-text"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    <p class="card-text"><a href="article.php?idArticle=<?php echo $donnees->idArticle ?>">Voir l'article</a></p>
    <p class="card-text"><a href="modifierMonArticle.php?idArticle=<?php echo $donnees->idArticle ?>">Modifier mon article</a></p>
    
</div>
</div>
<?php
}} // Fin de la boucle des billets
    
?>