<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include_once './include/menu.php'; ?>
<h4>Créer mon article </h4>

<?php 
require_once '../../function/db.php'; // Require la connexion a la base de donnée

$_SESSION['auth']->idUtilisateur;
$_SESSION['auth']->nomUtilisateur;


$reqCreationArticle = $pdo->prepare('INSERT INTO article SET auteur = ?, contenuArticle = ?, categorieArticle = ?, dateArticle = NOW() ');
$reqCreationArticle->execute([$_POST['nomAuteur'], $_POST['commentaire'], $_GET['billet']]);
?>
<form method ="POST" action="">

<label>Titre de l'article</label>
<input type="text" name="titreArticle"/>

<label>Contenu de l'article</label>
<input type="text" name="titreArticle"/>

<label>Votre commentaire</label>
<textarea type="text" name="commentaire"></textarea>

<button type="submit">Poster</button>