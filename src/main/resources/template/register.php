<?php include_once './include/header.php';
include_once './include/menu.php';
?>

<?php

if(!empty($_POST)) { // Si défférent de vide lance le reste
$errors = array();

require_once '../../function/db.php'; // Require la connexion a la base de donnée
include_once '../../function/functions.php';

if(empty($_POST['nomUtilisateur']) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST['nomUtilisateur'])) { // Si nomUtilisateur vide ou mauvais caractères
$errors['nomUtilisateur'] = "Votre nomUtilisateur n'est pas valide";

} else {

    // Vérifie si le nom d'utilisateur n'est pas déjà pris //
$req =$pdo->prepare('SELECT idUtilisateur FROM utilisateurs WHERE nomUtilisateur = ?');
$req->execute([$_POST['nomUtilisateur']]);
$user = $req->fetch();

if($user){
$errors['nomUtilisateur'] = 'Ce nomUtilisateur est déjà pris';

}}

// Verifie si l'emailUtilisateur est vide ou adress mail invalide
if(empty($_POST['emailUtilisateur']) || !filter_var($_POST['emailUtilisateur'], FILTER_VALIDATE_EMAIL)){
$errors['emailUtilisateur'] = "Votre Email n'est pas valide";

}   else {

$req =$pdo->prepare('SELECT idUtilisateur FROM utilisateurs WHERE emailUtilisateur = ?');
$req->execute([$_POST['emailUtilisateur']]);
$email = $req->fetch(); // Stop a la première ligne identique

if($email){
$errors['emailUtilisateur'] = 'Cette email est déjà utilisé pour un autre compte';

}}

// Verifie si mdpUtilisateur est vide ou mdpUtilisateurConfirm différent du mdpUtilisateur
if(empty($_POST['mdpUtilisateur']) || $_POST['mdpUtilisateur'] != $_POST['mdpUtilisateurConfirm']) { 
$errors['mdpUtilisateur'] = "Vous devez entrer un mot de passe valide";

} 

if(empty($errors)) { // SI pas d'erreurs dans la totalité des inputs

$req = $pdo->prepare("INSERT INTO utilisateurs SET nomUtilisateur = ?, mdpUtilisateur = ?, emailUtilisateur = ?, validationTokenUtilisateur = ?"); // Insert dans la bdd mais pas directement pour des questions de sécurités
$password = password_hash($_POST['mdpUtilisateur'], PASSWORD_BCRYPT); // Crypte le mot de passe 
$token = str_random(50);
$req->execute([$_POST['nomUtilisateur'], $password, $_POST['emailUtilisateur'], $token]); // Insert cette fois dans la base de donnée
$userId = $pdo->lastInsertId();
mail($_POST['emailUtilisateur'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur  le lien\n\nhttp://localhost/dev/blogPhp/src/main/resources/template/confirm.php?id=$userId&token=$token");

?>
<p class="color: green, backgournd-color: green">Un email vous as étais envoyez pour la validation<p>
    <button class="btn btn-primary"><a class="nav-link" href="login.php">Aller se connecter</a></button>
<?php   
exit();

}}

?>

<?php if(!empty($errors))  //<!---- Si erreur est different de vide lance un boucle qui montre les erreurs -------------------------->

foreach($errors as $error): ?>

<div class="alert alert-danger">

    <p>Vous n'avez pas rempli le formulaire correctement</p>


        <li><?= $error; ?></li>

<?php endforeach; ?>

</div>
<div class="container">
    
<h1 class="text-center">Inscription</h1 class="text-center">

<form method="POST" action="">

    <div class="form-group">

        <label for="">nomUtilisateur</label>
        <input type="text" name="nomUtilisateur" class="form-control"/>

        <label for="">Email</label>
        <input type="text" name="emailUtilisateur" class="form-control"/>

        <label for="">Mot de passe</label>
        <input type="password" name="mdpUtilisateur" class="form-control"/>

        <label for="">Confirmer votre mot de passe</label>
        <input type="password" name="mdpUtilisateurConfirm" class="form-control"/><br>

        <button type="submit" class="btn btn-primary">M'inscrire</button>

    </div>

</div>

</form>

<?php include_once 'include/footer.php';?>
