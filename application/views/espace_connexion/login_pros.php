<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
    <title>Connexion Pros</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center">Bienvenue !</h1>
        <h2>Espace Professionnels</h2>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Votre email">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <?= validation_errors(); ?>
        <p class="error"><?= $error ?></p>
        <a href="http://[::1]/code_igniter_arthur/Pros/forgot_password">Mot de passe oublié ?</a>
        <h4>Ou inscrivez-vous <a href="http://[::1]/code_igniter_arthur/Pros/inscription">ici</a> !</h4>
        <h4><a href="http://[::1]/code_igniter_arthur/Users/">Espace client</a></h4>
    </div>
</body>

</html>