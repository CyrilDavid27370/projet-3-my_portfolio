<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/projects-style.css">
    <title>Portfolio - Projets</title>

</head>

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

            
            <?php for ($i=1; $i <= 5; $i++) { ?>
            <div class="project-card">
                <div class="project-content">
                    <h2><a href="show.php" class="project-title">Coder comme un pro</a></h2>
                    <p class="project-description">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur ut dolorem voluptates rerum officiis est pariatur dolor aperiam tempora quibusdam.
                    </p>
                </div>
            </div>    
            <?php } ?>
        </div>
    </section>


</body>

</html>