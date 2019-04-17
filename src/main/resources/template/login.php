<?php
if(!empty($_POST) && !empty($_POST['nomUtilisateur']) && !empty($_POST['mdpUtilisateur'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien
    
require_once '../../function/db.php'; // Require la connexion a la base de donnée

$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE (nomUtilisateur = :nomUtilisateur OR emailUtilisateur = nomUtilisateur) AND dateInscriptionUtilisateur IS NOT NULL');
$req->execute(['nomUtilisateur' => $_POST['nomUtilisateur']]);
$user = $req->fetch(); // Récupère l'utilisateur
session_start();

if(password_verify($_POST['mdpUtilisateur'], $user->mdpUtilisateur)){

$_SESSION['auth'] = $user;
$_SESSION['flash']['success'] = 'Vous etes maintenant bien connecté';
header('Location: account.php');
exit();

} else {

$_SESSION['flash']['danger'] = "Heu vous avez fait une erreur d'email ou de mot de passe";
header('Location: login.php');
exit();

}
}

include_once './include/menu.php'; ?>

<div class="container">

    <h1 class="text-center">Se connecter </h1>

        <form method="POST" action="">

            <div class="form-group">

                <label for="">nomUtilisateur ou email</label>
                <input type="text" name="nomUtilisateur" class="form-control" required />

                <label for="">Mot de passe<a href="forget.php">(J'ai oublié mon mot de passe)</a></label>
                <input type="password" name="mdpUtilisateur" class="form-control" required/><br>

                <button type="submit" class="btn btn-primary">Se connecter</button><br>

                <br><label for="">Retour <a href="index.php">Acceuil</a></label>
               

        </form>
