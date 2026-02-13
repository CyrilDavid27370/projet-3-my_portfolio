<?php
session_start();
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = NULL;
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 

// Envoyer l'id de la page project.php vers la page show.php
// Récupérer l'id du projet qu'on veut afficher grace à $_GET
$id = $_GET['id'];

// Récupérer le projet souhaité dans la base de données
$pdo = new PDO('mysql:host=mysql; dbname=my_portfolio; charset=UTF8', 'user', 'pwd', );
$sql = "SELECT p.*, u.name as author FROM projects p
INNER JOIN users u
ON p.user_id=u.id
WHERE p.id=:id";
$request = $pdo->prepare($sql);
$request->execute(['id' => $id]);
$project = $request->fetch(PDO::FETCH_ASSOC);
$request->closeCursor();

// Formatage de la date
$date = new DateTimeImmutable($project['creation_date']);
$date = $date->format('d-m-Y');

// Afficher le titre, la description, etc du projet voulu dans la carte.
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/show-style.css">
    <title>Portfolio - Projets</title>
</head>

<body>
    <?php require('shared/_header.php'); ?>
    
    <section class="projects-section">
        <div class="project-card">
            <div class="project-content">
                <h2 class="project-title"><?php echo htmlspecialchars($project['title']) ?></h2>                     
                <p class="project-description">
                    <?php echo htmlspecialchars($project['description']) ?>
                </p>
                <div class="project-links">
                    <a href="<?php echo htmlspecialchars($project['url_git']) ?>" class="project-link secondary">GitHub</a>
                    <?php if ($user && $user['id'] === $project['user_id']) { ?>                   
                    <div class="delete"><a href="delete.php?id=<?php echo $project['id'] ?>&csrf_token=<?php echo $_SESSION['csrf_token'] ?>" onclick="return confirmDelete()">❌</a></div>
                    <div class="update"><a href="update.php?id=<?php echo $project['id'] ?>">✏️</a></div>
                    <?php } ?>
                </div>
                <div class="infos">
                    <div><?php echo $date ?></div>
                    <div><?php echo htmlspecialchars(ucfirst($project['author'])) ?></div>
                </div>
            </div>
        </div>    
    </section>
    <script>
        function confirmDelete() {
            return confirm("Etes-vous sûr de vouloir Supprimer ?");
        }
    </script>

</body>

</html>