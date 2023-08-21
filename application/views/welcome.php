<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Bienvenue sur Coiff'Hair";
require_once(APPPATH . 'views/includes/head.php');
session_destroy();
// Est-ce possible de faire en sorte de détruire la session uniquement si l'utilisateur cherche à changer de l'espace client à l'espace pro et vice-versa ?
?>

<body>
    <div class="header">
        <img id="icone" src="/code_igniter_arthur/assets/images/logo2.png" alt="coiffeur">
        <div class="small-container">
            <h1>Connectez-vous</h1>
            <div class="buttons">
                <a href="http://[::1]/code_igniter_arthur/Users" class="client client-button">Client</a>
                <a href="http://[::1]/code_igniter_arthur/Pros" class="pro pro-button">Pro</a>
            </div>
        </div>
    </div>
</body>

</html>