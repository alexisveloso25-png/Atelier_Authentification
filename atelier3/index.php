<?php
session_start();

if (isset($_SESSION['visites'])) {
    $_SESSION['visites'] += 1;  // incrémente à chaque chargement
} else {
    $_SESSION['visites'] = 1;   // initialisation à 1 pour la première visite
}

// Si un cookie et une session valides existent déjà, rediriger vers la bonne page
if (isset($_COOKIE['authToken']) && isset($_SESSION['authToken']) && $_COOKIE['authToken'] === $_SESSION['authToken']) {
    // Redirige selon le rôle enregistré
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {        // redirection admin 
        header('Location: page_admin.php');
        exit();
    } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {   // New utilisateur
        header('Location: page_user.php');
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

   
    if ($username === 'admin' && $password === 'secret') {     // Vérification des identifiants
        $token = bin2hex(random_bytes(16));
        $_SESSION['authToken'] = $token;
        $_SESSION['role'] = 'admin';
        setcookie('authToken', $token, time() + 60, '/', '', false, true);
        header('Location: page_admin.php');
        exit();

    } elseif ($username === 'user' && $password === 'utilisateur') {    // New identifiant
        $token = bin2hex(random_bytes(16));
        $_SESSION['authToken'] = $token;
        $_SESSION['role'] = 'user';
        setcookie('authToken', $token, time() + 60, '/', '', false, true);
        header('Location: page_user.php');
        exit();

    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier 3 — Authentification par Cookie</h1>
    <h3>Connectez-vous en tant que <strong>admin</strong> (mot de passe <em>secret</em>) ou <strong>user</strong> (mot de passe <em>utilisateur</em>).</h3>

    <!-- Compteur de visites -->
    <p>Vous avez visité cette page d'accueil <?= $_SESSION['visites'] ?> fois.</p>
    
    <form method="POST" action="">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>
        <br><br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <br>
    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
