<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4 class="text-center">Article</h4>
<?php
require_once '../../function/db.php'; // Require la connexion a la base de donnée
$idArticle = $_GET['idArticle'];
$article = $pdo->prepare('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article WHERE idArticle = :idArticle');
$article->bindParam(':idArticle', $idArticle);
$article->execute();

while ($donnees = $article->fetch())
{          
?>
<div class="card col-12 col-sm-12 col-md-8 col-lg-8 radius-10 m-auto">
<div class="card-body">
    <h5 class="card-title">
        <?php echo htmlspecialchars($donnees->titreArticle); ?>
    </h5>
    <div class="card-text">
    <?php echo $donnees->contenuArticle ?>
    </div>
    <p class="card-text"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    <p class="card-text">Posté par <b><?php echo $donnees->auteur ?></b></p>
</div>
<?php
} // Fin de la boucle des billets

?>