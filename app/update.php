<?php

// 1 - Affichage du formulaire
    // Créer le lien sur le crayon qui renvoie vers la page update
    // Créer le formulaire d'update en HTML (copier-coller à partir du create)
    // Injecter les valeurs du projet à updater dans les champs du formulaire

// Gérer la soumission du formulaire 
    // Si le form est soumis, on récupère les valeurs soumises ($_POST)
    // On les enregistre dans la BDD
    // Si ça marche, on vérifie les saisies de l'utilisateur

// Refactoriing, on vérifie si:
    // Pas d'injection sql
    // Pas de faille xss
    // pas de var_dump ou die dans le code
    // On indente correctement
    // On nettoye les sauts de ligne et les espaces