<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4>Créer mon article </h4>

<?php 
require_once '../../function/db.php'; // Require la connexion a la base de donnée

if (isset($_POST['poster'])) { 
    if(!empty($_POST['titreArticle'] && $_POST['contenuArticle'] && $_POST['idCategorie'])) {
$idUtilisateur = $_SESSION['auth']->idUtilisateur;
$auteur = $_SESSION['auth']->nomUtilisateur;


$reqCreationArticle = $pdo->prepare('INSERT INTO article SET auteur = :auteur, titreArticle = :titreArticle, contenuArticle = :contenuArticle,  dateArticle = NOW(), idUtilisateur = :idUtilisateur, idCategorie = :idCategorie, statutArticle = 0');

$reqCreationArticle-> bindParam(':auteur',  $auteur);
$reqCreationArticle-> bindParam(':titreArticle', $_POST['titreArticle']);
$reqCreationArticle-> bindParam(':contenuArticle', $_POST['contenuArticle']);
$reqCreationArticle-> bindParam(':idUtilisateur', $idUtilisateur);
$reqCreationArticle-> bindParam(':idCategorie', $_POST['idCategorie']);
$reqCreationArticle-> execute();
}}
?>


<form method="POST">

<label class="form-control">Titre de l'article</label>
<input type="text" class="form-control" name="titreArticle"/>

<label>Categorie de l'article</label>
<select id="select" class="form-control" name="idCategorie" class="selLieu">
                    <?php
                        
                        $categorieArticle = $pdo->query("SELECT * FROM categorie ORDER BY idCategorie");
                        while ($donnees = $categorieArticle->fetch()){ ?>
                        <option value="<?php echo $donnees->idCategorie; ?>"><?php echo $donnees->nomCategorie; ?></option>
                        <?php  } ?>
                        
                        
                </select>

<label>Contenu de votre article</label>
<textarea type="text" class="form-control" name="contenuArticle"></textarea>

<button class="btn btn-primary mt-3 col-12" type="submit" name="poster">Poster</button>
</form>