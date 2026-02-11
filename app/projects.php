<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/projects-style.css">
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
        <h1 class="section-title">Mes Projets</h2>
        <p class="p-add"><a href="add.php" class="add">➕</a></p>
        <div class="projects-list">
            <?php 
            // Récuper tous les projets avec PDO dans la variable $projects
            $pdo = new PDO('mysql:host=mysql; dbname=my_portfolio; charset=UTF8', 'user', 'pwd', );
            $sql = 'SELECT id, title, description FROM projects';
            $request = $pdo->prepare($sql);
            $request->execute();
            $projects = $request->fetchall(PDO::FETCH_ASSOC);
            $request->closeCursor();
            
            // Faire un foreach pour les récupérer un à un et Remplacer les valeurs en dur par les infos conetnues dans $projet
            foreach ($projects as $project) { 
                $description = substr($project['description'], 0, 200);
            ?>

            <div class="project-card">
                <div class="project-content">
                    <h2><a href="show.php?id=<?php echo $project['id'] ?>" class="project-title"><?php echo htmlspecialchars($project['title']) ?></a></h2>
                    <p class="project-description">
                        <?php echo htmlspecialchars($description) . '...' ?>
                    </p>
                </div>
            </div>

            <?php } ?>

        </div>
    </section>

</body>

</html>