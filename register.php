<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Register</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<?php include_once './includes/navbar.inc.php' ?>

<body>
    <form action="./includes/registerPost.inc.php" method="post" class="flex-column" enctype="multipart/form-data">
        <img src="./content/img/logo-principal.png" alt="Logo GlitchHunter Large Svg">
        <h1>Nouveau chez nous ? <span class="underline">Inscrivez-vous !</span></h1>
        <label for="username" class="requiredInputLabel">Pseudo : <span class="errorSpanMsg" id="errorUsernameMsg"></span></label>
        <input type="text" name="username" id="username" required class="">
        <label for="email" class="requiredInputLabel">Email : <span class="errorSpanMsg" id="errorEmailMsg"></span></label>
        <input type="email" name="email" id="email" required>
        <label for="password" class="requiredInputLabel">Mot de passe : <span class="errorSpanMsg" id="errorPasswordMsg"></span></label>
        <input type="password" name="password" id="password" required>
        <label for="verifyPassword" class="requiredInputLabel">Vérifiez votre mot de passe : <span class="errorSpanMsg" id="errorVerifyPasswordMsg"></span></label>
        <input type="password" name="verifyPassword" id="verifyPassword">
        <label for="profilPic" id="profilPicUploadZone">
            <p>Insérez une photo de profil :</p>
            <div class="button-primary" id="file-name">Importer une photo</div>
            <span class="errorSpanMsg" id="errorProfilPicMsg"></span>
        </label>
        <input type="file" name="profilPic" id="profilPic">
        <input type="submit" value="Créer mon compte" class="button-primary" id="submitFormButton">
        <a href="./login.php" class="button-secondary">Se connecter</a>
    </form>

    <script src="./js/register_form_validation.js"></script>
    <script src="./js/nav_profil_menu.js"></script>
</body>
</html>