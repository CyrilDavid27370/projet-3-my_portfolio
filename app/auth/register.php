<?php
$name='';
$error = '';

// On vérifie que le fomrulaire a été soumis
if(!empty($_POST)) {
    // On stocke les champs saisis dans des variables
    $name = $_POST['name'];
    $password = $_POST['password'];
    $passwordVerif = $_POST['passwordVerif'];

    // On verifie s'il ya des erreurs dans la saisie
    $error = verifCredentials($name, $password, $passwordVerif);

    // S'il n y'a pas d'erreur on enregistre en BDD le name et le mot de passe hashé
    if(!$error) {
        // On hash le mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // On ernegistre en BDD avec une requête préparé pour se protéger de l'injection SQL
        $pdo = new PDO('mysql:host=mysql;dbname=my_portfolio', 'user', 'pwd');
        $sql = "INSERT INTO users(name, password) VALUES (:name, :password)";
        $request = $pdo->prepare($sql);
         $request->execute([
            'name' => trim($name),
            'password' => $passwordHash
        ]);

        // On redirige vers la connection pour que le nouvel utilisateur puisse se connecter.
        header('Location: connection.php?register=1');
        exit;
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
    <h1>Enregistrement</h1>
    <form action="" method="post">
        Nom <input type="text" name="name" value="<?php echo $name ?>" required><br>
        Mot de passe <input type="password" name="password" required><br>
        Vérification du mot de passe <input type="password" name="passwordVerif"  required><br>
        <?php echo $error . '<br>'; ?>
        <input type="submit" value="Enregistrement">
        <tex></tex>
    </form>
    <p><a href="/">Retour à l'accueil</a></p>
</body>
</html>


<?php

// Fonction qui vérifie la saisie des des champs par l'utilisateur.
function verifCredentials(string $name, string $password, string $passwordVerif)
{
    // On vérifie que tous les champs ont été remplis
    if (empty($name) || empty($password) || empty($passwordVerif)) {
        return 'Tous les champs doivent être remplis.';
    }

    // On vérifie si lesm ot de passe sont identique
    if ($password !== $passwordVerif) {
        return 'Les mots de passe doivent être identiques.';
    }

    // On vérifie que le mot de passe à au moins 12 carcatères
    if (strlen($password) < 12) {
         return "Le mot de passe doit être d'au mons 12 caractères";
    }

    // Pour etre encore plus rigoureux précis on peut vérifier que le mot de passe à au moins 1 chiffre, 1 minuscule, 1 majuscule, un caractère spécial et au moins 12 caractères
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{12,}$/', $password)) {
        return "Le mot de passe contenir au mons 12 caractères et au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial.";
    }

    // On vérifie si le name existe dans la BDD
    $pdo = new PDO('mysql:host=mysql;dbname=my_portfolio', 'user', 'pwd');
    $sql = "SELECT * FROM users WHERE name=:name";
    $request = $pdo->prepare($sql);
    $request->execute([
        'name' => $name
    ]);
    $user = $request->fetch(PDO::FETCH_ASSOC);

    if($user) {
        return 'Ce name existe déjà.';
    }
}

