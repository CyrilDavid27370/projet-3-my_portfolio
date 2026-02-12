<?php
// Envoyer l'id de la page project.php vers la page show.php
// Récupérer l'id du projet qu'on veut afficher grace à $_GET
$id = $_GET['id'];

// Récupérer le projet souhaité dans la base de données
$pdo = new PDO('mysql:host=mysql; dbname=my_portfolio; charset=UTF8', 'user', 'pwd', );
$sql = "SELECT p.*, u.name as author FROM projects p
INNER JOIN user u
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
    
    <section class="projects-section">
        <div class="project-card">
            <div class="project-content">
                <h2 class="project-title"><?php echo htmlspecialchars($project['title']) ?></h2>                     
                <p class="project-description">
                    <?php echo htmlspecialchars($project['description']) ?>
                </p>
                <div class="project-links">
                    <a href="<?php echo htmlspecialchars($project['url_git']) ?>" class="project-link secondary">GitHub</a>                   
                    <div class="delete"><a href="">❌</a></div>
                    <div class="update"><a href="update.php?id=<?php echo $project['id']?>">✏️</a></div>
                </div>
                <div class="infos">
                    <div><?php echo $date ?></div>
                    <div><?php echo htmlspecialchars(ucfirst($project['author'])) ?></div>
                </div>
            </div>
        </div>    
    </section>

</body>

</html>