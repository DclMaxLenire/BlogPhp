<?php

function debug($variable){
echo '<pre>' . print_r($variable, true) . '</pre>';

}

function str_random($length){ // $Length c'est la taille choisis dans la fonction
$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN"; // Pioche parmis tout les caractères 
return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length); // Nous renvoi la clé

}

function loggedOnly(){ // Intedit l'accé si pas connecté
if(session_status() == PHP_SESSION_NONE) {
session_start();

} if(!isset($_SESSION['auth'])) {
$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
header('Location: login.php');
exit();
}}