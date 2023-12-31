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
    <img class="image" src="./content/img/logo-principal.png" alt="Logo GlitchHunter Large Svg">
    <form action="./includes/loginPost.inc.php" method="post" class="flex-column" style="margin-bottom: 50px">
        <h1>Vous souhaitez nous contacter ? Remplissez ce formulaire</h1>
        <label for="pseudo" class="requiredInputLabel">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <label for="subject" class="requiredInputLabel">Sujet</label>
        <input type="text" name="subject" id="subject" required>
        <label for="message" class="requiredInputLabel">Message</label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        
        <input type="submit" value="Envoyer le message" class="button-secondary">
    </form>

    <script src="./js/nav_profil_menu.js"></script>
    
</body>
</html>
