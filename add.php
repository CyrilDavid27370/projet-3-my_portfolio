<?php
session_start();
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = NULL;
}

if (!$user) {
    header('Location:/src/auth/connection.php');
    exit;
}

$pdo = new PDO('mysql:dbname=my_portfolio;host=mysql;charset=UTF8', 'user', 'pwd');
$sql = "SELECT * FROM users";
$request = $pdo->prepare($sql);
$request->execute();
$users = $request->fetchall(PDO::FETCH_ASSOC);

$message = NULL;
$description = '';
$title = '';
$urlGit = '';

//Si le formaulaire a été soumi
if(!empty($_POST)) {
    // On récupère les saisies utilisateurs ($_POST)
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $urlGit = trim($_POST['url_git']);
    $userId = (int)$_POST['user_id'];

    // On vérifie si les chmaps comportenet des erreurs
    require('service/function.php');
    $message = fieldsVerify($title, $description, $userId, $urlGit);

    // Si pas d'erreur sur les chamsp on enregistre dans la BDD
    if (!$message) {
        // 2) On les envoie dans la BDD
        $sql = "INSERT INTO projects(title, description, url_git, user_id) VALUES (:title, :description, :urlGit, :userId)";
        $request = $pdo->prepare($sql);
        $request->execute([
            'title' => $title,
            'description' => $description,
            'urlGit' => $urlGit,
            'userId' => $userId
        ]);
        header('Location:projects.php?message=ajouté');
        exit;
    }
}
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
    <?php require('shared/_header.php'); ?>
    
    <section class="form-section">
        <h2>Ajouter un projet</h2>

       <form action="" method="post">
            <label for="title">Titre du projet</label>
            <input type="text" name="title" maxlength="100" value="<?php echo $title ?>" required>
            <label for="description">Description du projet</label>
            <textarea name="description" rows="10" maxlength="1000" required><?php echo $description ?></textarea>
            <label for="url_git">URL github</label>
            <input type="text" name="url_git" value="<?php echo htmlspecialchars($urlGit) ?>">
            <label for="user_id">Auteur du projet</label>
            <select name="user_id" id="pet-select" required>
                <option value="">--Veuillez choisir une auteur--</option>
                <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['id'] ?>"><?php echo htmlspecialchars($user['name']) ?></option>
                <?php } ?>
            </select>

            <input type="submit" value="Ajouter" class="button">
            <?php echo "<p style='color:red'>$message</p>" ?>
       </form>
    </section>

</body>

</html>