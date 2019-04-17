<?php 
include_once './include/menu.php';

if(!empty($_POST) && !empty($_POST['emailUtilisateur'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien
    
    require_once '../../function/db.php'; // Require la connexion a la base de donnée
    include_once '../../function/functions.php';
    
    $req = $pdo->prepare('SELECT * FROM utilisateur WHERE emailUtilisateur = ? AND dateInscriptionUtilisateur IS NOT NULL');
    $req->execute([$_POST['emailUtilisateur']]);
    $user = $req->fetch(); // Récupère l'utilisateur
    session_start();
    
    if($user){
        $resetTokenUtilisateur = str_random(50);
        $req = $pdo->prepare('UPDATE utilisateur SET resetTokenUtilisateur = ?, resetDate = NOW() WHERE idUtilisateur= ?');
        $req = $req->execute([$resetTokenUtilisateur, $user->idUtilisateur]);
        $_SESSION['flash']['success'] = 'Vous pouvez changer de mot de passe via email';
        mail($_POST['emailUtilisateur'], 'Confirmation de changement de mot de passe', "Afin de valider votre compte merci de cliquer sur  le lien\n\nhttp://localhost/dev/blogPhp/src/main/resources/template/reset.php?id=$user->idUtilisateur&token=$resetTokenUtilisateur");
        header('Location: login.php');
        exit();    
    } else {
        
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond a cette email";
        header('Location: forget.php');
        exit();
}
}
?>

<?php include_once './include/header.php' ?>

<h5>Mot de passe oublié<h5>
    <form method="POST">
        <label for="">Email</label>
        <input type="email" name="emailUtilisateur" class="form-control" required/>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>