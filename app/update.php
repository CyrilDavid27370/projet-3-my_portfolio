<?php
// 1 - Affichage du formulaire
    // Créer le lien sur le crayon qui renvoie vers la page update
    // Créer le formulaire d'update en HTML (copier-coller à partir du create)
    // Injecter les valeurs du projet à updater dans les champs du formulaire

$id = $_GET['id'];

$pdo = new PDO('mysql:dbname=my_portfolio;host=mysql;charset=UTF8', 'user', 'pwd');
$sql = "SELECT * FROM projects WHERE id=:id";
$request = $pdo->prepare($sql);
$request->execute([
    'id' => $id
]);
$project = $request->fetch(PDO::FETCH_ASSOC);
$request->closeCursor();

// Récupérer tous els users pour les afficher dans l'imput select
$sql = "SELECT * FROM users";
$request = $pdo->prepare($sql);
$request->execute();
$users = $request->fetchAll(PDO::FETCH_ASSOC);


$message = '';
// Gérer la soumission du formulaire 
if (!empty($_POST)) {
    // Si le form est soumis, on récupère les valeurs soumises ($_POST)
    $title = $_POST['title'];
    $description = $_POST['description'];
    $urlGit = $_POST['url_git'];
    $userId = (int)$_POST['user_id'];

    // On vérifie les saisies de l'utilisateur
    require('service/function.php');
    $message = fieldsVerify($title, $description, $userId, $urlGit);

    if (!$message) {
        // On les enregistre dans la BDD
        $sql = "UPDATE projects SET title=:title, description=:description,url_git=:url_git, user_id=:user_id WHERE id=:id";
        $request = $pdo->prepare($sql);
        $request->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'url_git' => $urlGit,
            'user_id' => $userId
        ]);
        $request->closeCursor();

        header('Location:projects.php?message=modifié');
        exit;
    }
}

// Refactoriing, on vérifie si:
    // Pas d'injection sql
    // Pas de faille xss
    // pas de var_dump ou die dans le code
    // On indente correctement
    // On nettoye les sauts de ligne et les espaces
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/add-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>
    <header>
        <img src="../image/photo-profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Camile Ghastine</div>
        <nav>
            <ul class="nav-links">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="form-section">
        <h2>Modifier un projet</h2>

       <form action="" method="post">
            <label for="title">Titre du projet</label>
            <input type="text" name="title" maxlength="100" value="<?php echo htmlspecialchars($project['title']) ?>" required>
            <label for="description">Description du projet</label>
            <textarea name="description" rows="10" maxlength="1000" required><?php echo htmlspecialchars($project['description']) ?></textarea>
            <label for="url_git">URL github</label>
            <input type="text" name="url_git" value="<?php echo htmlspecialchars($project['url_git']) ?>">
            <label for="user_id">Auteur du projet</label>
            <select name="user_id" required>
                <option value="">--Veuillez choisir une auteur--</option>
                <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['id'] ?>" <?php echo ($user['id'] === $project['user_id']) ? 'selected' : '' ?>>
                    <?php echo htmlspecialchars($user['name']) ?>
                </option>
                <?php } ?>
            </select>
            <input type="submit" value="Modifier" class="button">
            <?php echo "<p style='color:red'>$message</p>" ?>
       </form>
    </section>

</body>

</html>