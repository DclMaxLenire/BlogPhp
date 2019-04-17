<?php 
include_once '../../function/functions.php';
loggedOnly();
include_once './include/menu.php';

$statut = $_SESSION['auth']->statutUtilisateur;
if($_SESSION['auth'] && $statut == 1) {
?> <h4 class="text-center">Bienvenu sur la page Admin <?= $_SESSION['auth']->nomUtilisateur; ?></h4>
<h4 class="text-center">Gerer les articles en attentes</h4>

<?php
require_once '../../function/db.php'; // Require la connexion a la base de donnée
$article = $pdo->prepare('SELECT * FROM article');
$article->execute();

while ($donnees = $article->fetch())
{          
?>
<div class="card col-12 col-sm-12 col-md-8 col-lg-8 radius-10 m-auto">
<div class="card-body">
    <h5 class="card-title">
        <?php echo htmlspecialchars($donnees->titreArticle); ?>
        <p class="card-text"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    </h5>
    <p class="card-text">Posté par <b><?php echo $donnees->auteur ?></b></p>
    
   <p class="card-text"><a href="modifierArticleAdmin.php?idArticle=<?php echo $donnees->idArticle ?>">Voir l'article</a></p>
    
</div>
</div>
<?php
}} // Fin de la boucle des billets

?>








