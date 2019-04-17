<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="../static/style/style.css">
            <link rel="stylesheet" href="../static/style/bootstrap.min.css">
            <title>Document</title>
        </head>
            <body>
<?php include_once './include/menu.php'; ?>

<body>
<div class="bg-grey radius-10">
<h4 class="text-center mt-3 text-Mydark">Bienvenu sur Le blog</h4>
</div>

<div class="col-12 col-sm-12 col-md-5 col-lg-5 m-auto">
<img src="../static/style/img/logo.png" class="img-fluid" alt="Responsive image">
</div>
<h4 class="text-center mt-3 mb-3 bg-red radius-10 text-Mydark">Les 5 derniers articles</h4>
<?php require_once '../../function/db.php'; // Require la connexion a la base de donnée 

$reqArticle = $pdo->query('SELECT idArticle, statutArticle, auteur, titreArticle, contenuArticle,  DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCreationFr FROM article WHERE statutArticle = 1 ORDER BY idArticle DESC LIMIT 5');
while ($donnees = $reqArticle->fetch())
{
?>
<div class="card col-12 col-sm-12 col-md-8 col-lg-8 radius-10 m-auto">
<div class="card-body">
    <h5 class="card-title">
        <?php echo htmlspecialchars($donnees->titreArticle); ?>
    </h5>
    <p class="card-text m-0">Posté par <b><?php echo $donnees->auteur ?></b></p>
    <p class="card-text m-0"><em> Posté le <b><?php echo $donnees->dateCreationFr ?></b></em></p>
    
   <p class="card-text"><a href="article.php?idArticle=<?php echo $donnees->idArticle ?>">Voir l'article</a></p>
    
</div>
<?php
} // Fin de la boucle des billets

?>
</body>