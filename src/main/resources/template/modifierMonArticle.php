<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
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
<div class="news">
<h3>
<?php echo htmlspecialchars($donnees->titreArticle); ?>
<em> posté le <?php echo $donnees->dateCreationFr ?></em>
</h3>

<p>
<?php
// On affiche le contenu du billet
echo nl2br(htmlspecialchars($donnees->contenuArticle));
}
?>







<?php
if (isset($_POST['modifier'])) {
$idUtilisateur = $_SESSION['auth']->idUtilisateur;
$auteur = $_SESSION['auth']->nomUtilisateur;
$reqModificationArticle = $pdo->prepare('UPDATE article SET auteur = :auteur, titreArticle = :modificationTitre, contenuArticle = :modificationContenu,  dateArticle = NOW(),  idCategorie = :modificationCategorie, statutArticle = 0, dateModification = NOW(), idUtilisateur = :idUtilisateur WHERE idArticle = :idArticle');
$reqModificationArticle-> bindParam(':auteur',  $auteur);
$reqModificationArticle-> bindParam(':modificationTitre', $_POST['modificationTitre']);
$reqModificationArticle-> bindParam(':modificationContenu', $_POST['modificationContenu']);
$reqModificationArticle-> bindParam(':idUtilisateur', $idUtilisateur);
$reqModificationArticle-> bindParam(':modificationCategorie', $_POST['modificationCategorie']);
$reqModificationArticle-> bindParam(':idArticle', $idArticle);
$reqModificationArticle-> execute();
}

?>



<h4>Nouveau contenu<h4>
<form method="POST">

<div class="card">

<label>Titre de l'article</label>
<input type="text" name="modificationTitre"/>

<label>Categorie de l'article</label>
<select id="select" class="form-control" name="modificationCategorie" class="selLieu">
                    <?php
                        
                        $categorieArticle = $pdo->query("SELECT * FROM categorie ORDER BY idCategorie");
                        while ($donnees = $categorieArticle->fetch()){ ?>
                        <option value="">Choisir la categorie</option> 
                        <option value="<?php echo $donnees->idCategorie; ?>"><?php echo $donnees->nomCategorie; ?></option>
                        <?php  } ?>
                        
                        
                </select>

<label>Contenu de votre article</label>
<textarea type="text" name="modificationContenu"></textarea>

<button type="submit" name="modifier">Poster</button>
</div>
</form>