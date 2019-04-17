<?php
if(isset($_GET['id']) && ($_GET['token'])) {

require_once '../../function/db.php'; // Require la connexion a la base de donnée

$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE idUtilisateur = ? AND resetTokenUtilisateur = ? AND resetDate > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
$req->execute([$_GET['id'], $_GET['token']]);
$user = $req->fetch();

if($user) {
    if(!empty($_POST)) {
        if(!empty([$_POST]) && $_POST['mdpUtilisateur'] == $_POST['mdpUtilisateurConfirm']) {

$password = password_hash($_POST['mdpUtilisateur'], PASSWORD_BCRYPT);
$pdo->prepare('UPDATE utilisateurs SET mdpUtilisateur = ?')->execute([$password]);
session_start();
$_SESSION['auth'] = $user;
$_SESSION['flash']['success'] = "Votre mot de passe à était modifié";
header('Location: login.php');
exit();

} else {

$_SESSION['flash']['danger'] = "Ce token n'est pas valide";
header('Location: login.php');

exit();

}}}}

?>

<h5>Changer votre mot de passe</h5>

<form method="POST" action="">

<div class="form-group">

    <label for="">Mot de passe</label>
    <input type="password" name="mdpUtilisateur" class="form-control" />

    <label for="">Confirmer votre mot de passe</label>
    <input type="password" name="mdpUtilisateurConfirm" class="form-control" />

    <button type="submit" class="btn btn-primary">Rénitialiser votre mot de passe</button>

</form>
