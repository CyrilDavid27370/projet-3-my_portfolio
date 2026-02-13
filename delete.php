<?php
session_start();
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = NULL;
}

$id = $_GET['id'];

if (!$user || $user['id'] !== $id) {
    header('Location:/index.php');
    exit;
}

if (isset($_GET['csrf_token'])) {
    $csrf_token = $_GET['csrf_token'];
} else {
    $csrf_token = NULL;
}

// avant de delete le projet, vérifier que le lien n'est pas un lien envoyé par quelqu'un d'autre. 
// Vérifier que l'urtilisateur à bien cliqué lui même sur le bouton

if ($csrf_token === $_SESSION['csrf_token']) {
    $pdo = new PDO('mysql:host=mysql; dbname=my_portfolio; charset=UTF8', 'user', 'pwd', );
    $sql="DELETE FROM projects WHERE id=$id";
    $request = $pdo->prepare($sql);
    $request->execute();

    header('Location:projects.php?message=supprimé');
    exit;
} else {
    echo 'Jeton Csrf invalide. <br><a href="projects.php">Retour aux projets.</a>';
}
