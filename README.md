# Informations de connexion

## Application web

| Service | URL |
|---|---|
| Site web | http://localhost:8080 |
| PhpMyAdmin | http://localhost:8081 |

## MySQL

| Paramètre | Valeur |
|---|---|
| Hôte | mysql (depuis PHP) / localhost (depuis votre machine) |
| Port | 3306 |
| Base de données | my_portfolio |
| Utilisateur | user |
| Mot de passe | pwd |
| Utilisateur root | root |
| Mot de passe root | root |

## PhpMyAdmin

| Paramètre | Valeur |
|---|---|
| URL | http://localhost:8081 |
| Utilisateur | user |
| Mot de passe | pwd |

## Connexion PHP

```php
$pdo = new PDO(
    'mysql:host=mysql;dbname=my_portfolio',
    'user',
    'pwd'
);
```

## Commandes Docker utiles

| Commande | Description |
|---|---|
| `docker compose up -d` | Démarre tous les conteneurs |
| `docker compose down` | Arrête tous les conteneurs |
| `docker volume rm mysql_data` | Supprime les données MySQL |
| `docker compose down --volumes` | Arrête les conteneurs et supprime les données |
| `docker volume ls` | Liste tous les volumes |
