<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/projects-style.css">
    <title>Portfolio - Projets</title>
</head>

<?php
$pdo = new PDO('mysql:host=mysql;dbname=my_portfolio;charset=utf8', 'user', 'pwd');
$sql = 'SELECT id, title, description FROM projects';
$request=$pdo->prepare($sql);
$request->execute();
$projects = $request->fetchAll(PDO::FETCH_ASSOC) ;
?>

<body>
    <header>
        <img src="image/photo-profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Camile Ghastine</div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="projects-section">
        <h1 class="section-title">Mes Projets</h2>
        <div class="projects-list">

            <?php foreach ($projects as $project) { ?>
                
            <div class="project-card">
                <div class="project-content">
                    <h2><a href="show.php?id=<?php echo $project['id'] ?>" class="project-title"><?php echo htmlspecialchars($project['title'])?></a></h2>
                    <p class="project-description">
                    <?php echo htmlspecialchars($project['description']) ?>
                    </p>
                </div>
            </div> 

            <?php } ?>

        </div>
    </section>
</body>
</html>