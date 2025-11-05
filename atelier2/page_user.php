<?php
session_start();

// Vérifie que l'utilisateur est bien authentifié et qu'il s'agit d'un "user"
if (!isset($_COOKIE['authToken']) 
    || $_COOKIE['authToken'] !== ($_SESSION['authToken'] ?? null)
    || ($_SESSION['role'] ?? '') !== 'user') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur</title>
</head>
<body>
    <h1>Bienvenue sur votre espace utilisateur 👋</h1>
    <p>Vous êtes connecté en tant que <strong>user</strong>.</p>
    <p>Votre jeton d'authentification :</p>
    <pre><?= htmlspecialchars($_COOKIE['authToken']) ?></pre>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
