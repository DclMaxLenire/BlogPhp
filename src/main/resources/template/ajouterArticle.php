<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4>Créer mon article </h4>

<?php 
require_once '../../function/db.php'; // Require la connexion a la base de donnée

$idUtilisateur = $_SESSION['auth']->idUtilisateur;
$auteur = $_SESSION['auth']->nomUtilisateur;


$reqCreationArticle = $pdo->prepare('INSERT INTO article SET auteur = :auteur, titreArticle = :titreArticle, contenuArticle = :contenuArticle,  dateArticle = NOW(), idUtilisateur = :idUtilisateur, idCategorie = :idCategorie, statutArticle = 0');

$reqCreationArticle-> bindParam(':auteur',  $auteur);
$reqCreationArticle-> bindParam(':titreArticle', $_POST['titreArticle']);
$reqCreationArticle-> bindParam(':contenuArticle', $_POST['contenuArticle']);
$reqCreationArticle-> bindParam(':idUtilisateur', $idUtilisateur);
$reqCreationArticle-> bindParam(':idCategorie', $_POST['idCategorie']);
$reqCreationArticle-> execute();
?>


<form method="POST">

<div class="card">

<label>Titre de l'article</label>
<input type="text" name="titreArticle"/>

<label>Categorie de l'article</label>
<select id="select" class="form-control" name="idCategorie" class="selLieu">
                    <?php
                        
                        $categorieArticle = $pdo->query("SELECT * FROM categorie ORDER BY idCategorie");
                        while ($donnees = $categorieArticle->fetch()){ ?>
                        <option value="">Choisir la categorie</option> 
                        <option value="<?php echo $donnees->idCategorie; ?>"><?php echo $donnees->nomCategorie; ?></option>
                        <?php  } ?>
                        
                        
                </select>

<label>Contenu de votre article</label>
<textarea type="text" name="contenuArticle"></textarea>

<button type="submit">Poster</button>
</div>