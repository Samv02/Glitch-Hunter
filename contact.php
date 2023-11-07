<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Contact</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<?php include_once './includes/navbar.inc.php'; ?>

<body>
    <img src="./content/img/logo-principal.png" alt="Logo GlitchHunter Large Svg">
    <form action="./includes/loginPost.inc.php" method="post" class="flex-column">
        <h1>Connectez-vous!</h1>
        <label for="email" class="requiredInputLabel">Email : <span class="errorSpanMsg" id="errorEmailMsg"></span></label>
        <input type="email" name="email" id="email" required>
        <label for="password" class="requiredInputLabel">Mot de passe : <span class="errorSpanMsg" id="errorPasswordMsg"></span></label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Se connecter" class="button-primary">
        <a href="./register.php" class="button-secondary">S'inscrire</a>
    </form>

    <script src="./js/login_form_validation.js"></script>
    <script src="./js/nav_profil_menu.js"></script>
</body>
</html>