<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <img id="icone" src="/code_igniter_arthur/assets/images/coiffeur.png" alt="coiffeur">
        <h1 style="text-align: center">Bienvenue chez 'Tête en L'Hair' !</h1>
        <h2>Veuillez vous connecter :</h2>
        <form action="" method="post">
            <input type="text" name="identifiant" placeholder="Votre identifiant">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <a href="http://[::1]/code_igniter_arthur/Users/forgot_password">Mot de passe oublié ?</a>
        <p class="error"><?= $error ?></p>
        <h4>Ou inscrivez-vous <a href="http://[::1]/code_igniter_arthur/Users/inscription">ici</a> !</h4>
    </div>
</body>

</html>