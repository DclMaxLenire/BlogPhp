<?php

$userId = $_GET['id'];
$token = $_GET['token'];

require_once '../../function/db.php'; // Require la connexion a la base de donnée

$req= $pdo->prepare('SELECT * FROM utilisateurs WHERE idUtilisateur = ?');
$req->execute([$userId]);
$user = $req->fetch();

// Permet de validé l'inscription de l'utilisateur 
if($user && $user->validationTokenUtilisateur == $token) {
session_start();
$pdo->prepare('UPDATE utilisateurs SET validationTokenUtilisateur = NULL, dateInscriptionUtilisateur = NOW() WHERE idUtilisateur = ?')->execute([$userId]);
$_SESSION['flash']['success'] = 'Votre compte a bien été validé';
$_SESSION['auth'] = $user;
header('Location: account.php');
die('ok');
} else{

$_SESSION['flash']['danger'] = "Ce token n'est plus valide";
header('Location: login.php');
exit();

}