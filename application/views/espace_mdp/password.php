<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
</head>
<div class="container">
    <h2>Réinitialisation de votre mot de passe :</h2>
    <form action="" method="post">
        <input placeholder="Indiquez votre adresse mail" type="email" name="email">
        <input type="submit" value="Envoyer">
    </form>
    <p class="error"><?= $error ?></p>
    <p class="valid"><?= $valid ?></p>

    <a href="http://[::1]/code_igniter_arthur/Users">Retour</a>
</div>

<body>

</body>

</html>