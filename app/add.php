<?php
// 1) Si le formaulaire a été soumi, alors on récupère les saisies utilisateurs ($_POST)
// 2) On les envoie dans la BDD
// 
// 3) Quand vous aures réussi le 1 et le 2. Il faudra vérifier les données saisies avant de les erngistrées.
//    si les données sont valides alors on enregistre en bdd, sinon on envoie un message pour expliquer l'erreur. 




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
        <h2>Ajouter un projet</h2>

    <form action="" method="post">
            <label for="title">Titre du projet</label>
            <input type="text" name="title" maxlength="100" required>
            <label for="description">Description du projet</label>
            <textarea name="description" rows="10" maxlength="1000" required></textarea>
            <label for="url_git">URL github</label>
            <input type="url" name="url_git">
            <label for="">Auteur du projet</label>
            <input type="text">
            <input type="submit" value="Ajouter" class="button">
    </form>
    </section>

</body>

</html>