<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4> Les articles <h4>

<?php require_once '../../function/db.php'; // Require la connexion a la base de donnée 

$reqArticle = $pdo->query('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article ORDER BY dateArticle');
while ($donnees = $reqArticle->fetch())
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
    
</div>
<?php
} // Fin de la boucle des billets

?>