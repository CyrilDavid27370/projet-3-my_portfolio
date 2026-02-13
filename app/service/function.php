<?php
function fieldsVerify($title, $description, $userId, $urlGit) {
    // Vérifier que les chmaps ne sont pas vides
    if(empty($title) || empty($description) || empty($userId)) {
        return 'Tous les champs doivent être renseignés.';
    }


    //  Vérifier que le titre à moins de 100 caractères
    if(strlen($title) > 100) {
        return 'Le titre ne doit pas dépasser 100 caractères.';
    }

    // Vérifier que la description à moins de 1000 caractère
    if(strlen($description) > 1000) {
        return 'La description ne doit pas dépasser 1000 caractères.';
    }

    // Vérifier si l'url siasi est bien une url valide
    $regex = "/^(https?:\/\/)[\w\-]+(\.[\w\-]+)+([\/\w\-\.\?\=\#\&\%]*)?$/";
    if ($urlGit && !preg_match($regex, $urlGit)) {
        return "L'url saisie n'est pas valide";
    }
}
