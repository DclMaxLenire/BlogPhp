<?php include_once './include/header.php';?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Acceuil <span class="sr-only">(current)</span></a>
        </li>
    
     
        <?php  if(isset($_SESSION['auth'])): ?> <!------- Si connecté on affiche --------->
        <li class="nav-item"><a class="nav-link" href="logout.php">Se déconnecter</a></li>
        <li class="nav-item"><a class="nav-link" href="account.php">Mon compte</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php">Retour Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="article.php">Les articles</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouterArticle.php">Creer un article</a></li>

        <?php else: ?> <!------- Si pas connecté on afficher -------------------->
        <li class="nav-item"><a class="nav-link" href="register.php">S'inscrire</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Se connecter</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php">Retour Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="article.php">Les articles</a></li>
        
        <?php endif; ?>
        
        <?php if(isset($_SESSION['flash'])): ?> <!----- Gère les messages d'erreurs ----------->
        <?php foreach($_SESSION['flash'] as $type => $message): ?>

        <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>
        </div>

        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?> <!--------- Supprime le message d'erreur ---------------->
        <?php endif; ?>

    </ul>
</nav>