<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
</head>

<body>
    <div class=" container">
        <h1>Bienvenue sur notre page d'inscription !</h1>
        <h2>Avec Form Validation</h2>
        <form action="" method="post">
            <input placeholder="Votre Pseudo" name="pseudo" type="text">
            <input placeholder="Votre Email" name="email" type="text">
            <input minlength="6" placeholder="Votre Mot de Passe" name="password" type="password">
            <i>6 caractères minimum</i>
            <input placeholder="Confirmer Votre MDP" name="confirm_password" type="password">
            <input type="submit" value="Envoyer">
        </form>
        <p class="error"><?= $error ?></p>
        <p class="valid"><?= $valid ?></p>
        <p>Retour à la <a href="http://[::1]/code_igniter_arthur/Users">page de connexion</a></p>
    </div>
</body>

</html>