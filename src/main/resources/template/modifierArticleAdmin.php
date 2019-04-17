<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php 
$statut = $_SESSION['auth']->statutUtilisateur;
if($_SESSION['auth'] && $statut == 1) {
include_once './include/menu.php'; ?>
<h4>Page modification d'article</h4>
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
        <p class="card-text"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    </h5>
    <p class="card-text">Posté par <b><?php echo $donnees->auteur ?></b></p>
    <div class="card-text">
    <?php echo $donnees->contenuArticle ?>
    </div>
    
</div>
</div>
<?php
} // Fin de la boucle des billets

?>


<?php
if (isset($_POST['modifier'])) {
$idUtilisateur = $_SESSION['auth']->idUtilisateur;
$reqModificationArticle = $pdo->prepare('UPDATE article SET titreArticle = :modificationTitre, contenuArticle = :modificationContenu,  dateArticle = NOW(),  idCategorie = :modificationCategorie, statutArticle = :statutChange, dateModification = NOW(), idUtilisateur = :idUtilisateur WHERE idArticle = :idArticle');
$reqModificationArticle-> bindParam(':modificationTitre', $_POST['modificationTitre']);
$reqModificationArticle-> bindParam(':modificationContenu', $_POST['modificationContenu']);
$reqModificationArticle-> bindParam(':idUtilisateur', $idUtilisateur);
$reqModificationArticle-> bindParam(':modificationCategorie', $_POST['modificationCategorie']);
$reqModificationArticle-> bindParam(':idArticle', $idArticle);
$reqModificationArticle-> bindParam(':statutChange', $_POST['statutChange']);
$reqModificationArticle-> execute();
}

?>





<!-- PARTIE MODIFICATION ARTICLE -->
<?php
$idArticle = $_GET['idArticle'];
$article = $pdo->prepare('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article WHERE idArticle = :idArticle');
$article->bindParam(':idArticle', $idArticle);
$article->execute();

while ($donnees = $article->fetch())
{          
?>


<h4 class="text-center mt-3 mb-3 bg-dark radius-10">Nouveau contenu</h4>
<form method="POST">
<div class="form-group">
<label>Afficher contenu = 1 Retirer = 0</label>
<input  class="form-control"type="text" name="statutChange"  value="<?php echo $donnees->statutArticle?>" placeholder="Mettre 0 ou 1"/>

<label>Titre de l'article</label>
<input  class="form-control"type="text" name="modificationTitre" value="<?php echo $donnees->titreArticle?>"/>

<label>Contenu de votre article</label>
<textarea type="text" class="form-control" name="modificationContenu"><?php echo $donnees->contenuArticle ?></textarea>

<label>Categorie de l'article</label>
<select id="select" class="form-control" name="modificationCategorie" class="selLieu">
                    <?php
                        
                        $categorieArticle = $pdo->query("SELECT * FROM categorie ORDER BY idCategorie");
                        while ($donnees = $categorieArticle->fetch()){ ?>
                        <option value="<?php echo $donnees->idCategorie; ?>"><?php echo $donnees->nomCategorie; ?></option>
                        <?php  } ?>
                        
                        
                </select>

<button type="submit" class="btn btn-primary mt-3 col-12" name="modifier">Poster</button>
</div>
</form>
<?php
}}?>