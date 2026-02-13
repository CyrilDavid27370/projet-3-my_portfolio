<?php
session_start();

$message ='';

if (isset($_GET['register']) && $_GET['register'] === '1') {
    $message = 'Votre enregsitrement a été réalisé avec succès !<br> Vous pouvez maintenant vous connecter.';
}

// si le formulaire a été soumis --> On stocker les données du formulaire dans des variables PHP
if(!empty($_POST)) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // On récupère de la BDD le password du name saisi par l'utilisateur
    $pdo = new PDO('mysql:host=mysql;dbname=my_portfolio', 'user', 'pwd');

    $sql="SELECT * FROM users WHERE name=:name";
    $request = $pdo->prepare($sql);
    $request->execute([
        'name' => $name
    ]);
    $user = $request->fetch(PDO::FETCH_ASSOC);
    
    // si les mot de passe concordent [fonnction php password_verify($pwdSaisi, $pwdFromBdd)]
    if ($user && password_verify($password, $user['password'])) {
        // on enregistre en session $_SESSION['name'] = $user
        $_SESSION['user'] = $user;
        header('Location: /index.php');
        exit;
    } else {
        // Sinon on affiche un message d'erreur
        $message = 'Les identifiants sont incorrects !';
    }    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post">
        Nom <input type="text" name="name" required> <br>
        Mot de passe <input type="password" name="password" rquired><br>
        <input type="submit" value="Connexion"> <?php echo $message ?>
    </form>
    <p><a href="/">Retour à l'accueil</a></p>
</body>
</html>