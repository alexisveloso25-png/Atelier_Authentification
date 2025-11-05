<?php
session_start();

// Vérifie que l'utilisateur est bien authentifié et qu'il s'agit d'un admin
if (!isset($_COOKIE['authToken']) 
    || $_COOKIE['authToken'] !== ($_SESSION['authToken'] ?? null)
    || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Admin</title>
</head>
<body>
    <h1>Bienvenue sur la page Administrateur 🔐</h1>
    <p>Vous êtes connecté en tant qu’<strong>admin</strong>.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
