<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4 class="text-center">Les articles<h4>

<?php require_once '../../function/db.php'; // Require la connexion a la base de donnée 

$reqArticle = $pdo->query('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article  WHERE statutArticle = 1');
while ($donnees = $reqArticle->fetch())
{
?>
<div class="card col-12 col-sm-12 col-md-8 col-lg-8 radius-10 m-auto">
<div class="card-body">
    <h5 class="card-title">
        <?php echo htmlspecialchars($donnees->titreArticle); ?>
        <p class="card-text"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    </h5>
    <p class="card-text">Posté par <b><?php echo $donnees->auteur ?></b></p>
    
   <p class="card-text"><a href="article.php?idArticle=<?php echo $donnees->idArticle ?>">Voir l'article</a></p>
    
</div>
<?php
} // Fin de la boucle des billets

?>