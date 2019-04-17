<?php 
include_once '../../function/functions.php';
loggedOnly();
include_once './include/menu.php';
?>
        <h2 class="text-center">Mon compte</h2>
        <h5 class="text-center">Bonjour  <?= $_SESSION['auth']->nomUtilisateur; ?></h5>

            <div class="container">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> <a class="nav-link" href="themeChoix.php">Répondre à un questionaire</a></li>
            </ol>
            </nav>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="creationQuestionnaire.php">Crée un questionaire</a></li>
        </ol>
        </nav>
    
<?php 
require_once '../../function/db.php'; // Require la connexion a la base de donnée

$statut = $_SESSION['auth']->statut;
if($_SESSION['auth'] && $statut == "admin") {

?>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a class="nav-link" href="admin.php">Aller sur la page admin</a></li>
        </ol>
        </nav>
        </div>
<?php

}


