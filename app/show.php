<?php
$id=$_GET['id'];

$pdo = new PDO('mysql:host=mysql;dbname=my_portfolio;charset=utf8', 'user', 'pwd');
$sql = "SELECT p.*, u.name as author FROM projects p
INNER JOIN user u
ON u.id=p.user_id
WHERE p.id = :id";
$request = $pdo->prepare($sql);
$request->execute(['id'=>$id]);
$project=$request->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/show-style.css">
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
        <h2 class="section-title">Mon Projet</h2>    
        <div class="project-card">
            <div class="project-content">
                <h2 class="project-title"><?php echo htmlspecialchars($project['title']) ?></h2>                     
                <p class="project-description">
                <?php echo htmlspecialchars($project ['description'])?></p>
                    <a href="<?php echo htmlspecialchars($project['url_git'])?>" class="project-link secondary">GitHub</a>                   
                    <div class="delete"><a href="">❌</a></div>
                    <div class="update"><a href="">✏️</a></div>
                </div>
                <div class="infos">
                    <div><?php echo date('d/m/Y', strtotime($project['creation_date'])); ?></div>
                    <div><?php echo htmlspecialchars($project['author'])?></div>
                </div>
            </div>
        </div>    
</section>
</body>
</html>