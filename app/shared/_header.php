    <header>
        <img src="../image/photo-profil.jpg" alt="photo de profil" class="photo-profil">
        <div class="name">Camile Ghastine</div>
        <nav>
            <ul class="nav-links">
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/src/projects.php">Projets</a></li>
                <li><a href="#">Contact</a></li>
                <?php if (!$user) { ?>
                <li><a href="/src/auth/connection.php">Connexion</a> / <a href="/src/auth/register.php">Enregistrement</a></li>
                <?php } else { ?>
                <li><a href="/src/auth/deconnection.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>