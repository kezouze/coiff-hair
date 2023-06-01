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
        <h1 style="text-align: center"><span class="welcome">Bienvenue chez</span><i class="titre">Coiff' Hair !</i></h1>
        <img id="icone" src="/code_igniter_arthur/assets/images/coiffeur.png" alt="coiffeur">
        <form action="" method="post">
            <input type="text" name="identifiant" placeholder="Votre identifiant">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <a href="http://[::1]/code_igniter_arthur/Users/forgot_password">Mot de passe oublié ?</a>
        <p class="error"><?= $error ?></p>
        <hr class="dashed">
        <h4>Ou <a href="http://[::1]/code_igniter_arthur/Users/inscription">inscrivez-vous</a> !</h4>
        <h4><a href="http://[::1]/code_igniter_arthur/Pros">Espace professionnel</a></h4>
    </div>
</body>

</html>