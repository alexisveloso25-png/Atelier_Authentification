<?php
// Démarre la session
session_start();

// Compteur de visites
if (isset($_SESSION['visites'])) {
    $_SESSION['visites'] += 1; // incrémente si déjà défini
} else {
    $_SESSION['visites'] = 1;  // initialise à 1 si première visite
}

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin/page_admin.php'); // exemple si page déplacée
        exit();
    } elseif ($_SESSION['role'] === 'user') {
        header('Location: user/page_user.php'); // exemple si page déplacée
        exit();
    }
}

// Gérer le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'secret') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header('Location: admin/page_admin.php');
        exit();

    } elseif ($username === 'user' && $password === 'utilisateur') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header('Location: user/page_user.php');
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
    <title>Atelier 3 — Authentification par Session</title>
</head>
<body>
    <h1>Atelier 3 — Authentification par Session</h1>

    <!-- Affichage du nombre de visites -->
    <p>Vous avez visité cette page d'accueil <?= $_SESSION['visites'] ?> fois.</p>

    <form method="POST" action="">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
