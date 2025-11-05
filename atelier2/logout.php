<?php
// Supprime le cookie d'authentification
setcookie('authToken', '', time() - 60, '/', '', false, true); // Cookie expiré par la valeur -60. Il n'est donc plus valable

// Redirection vers la page de connexion
header('Location: index.php');
exit();
?>
