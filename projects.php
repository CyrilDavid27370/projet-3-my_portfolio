<?php
session_start();
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = NULL;
}

$message = isset($_GET['message']) ? 'Le projet a été ' . $_GET['message'] .' avec succès' : NULL;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/projects-style.css">
    <title>Portfolio - Projets</title>

</head>

<body>
    <?php require('shared/_header.php'); ?>

    <section class="projects-section">
        <?php echo "<div style='color:green'>$message</div>" ?>
        <h1 class="section-title">Mes Projets</h2>
        <?php if ($user) { ?>
        <p class="p-add"><a href="add.php" class="add">➕</a></p>
        <?php } ?>
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