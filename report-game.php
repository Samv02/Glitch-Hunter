<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Ajouter un jeu</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/report-game.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<?php include_once './includes/navbar.inc.php'; ?>

<?php
// Récupérer l'URL actuelle
$currentURL = $_SERVER['REQUEST_URI'];

// Vérifier si "?reg_err=success" est présent dans l'URL
if (strpos($currentURL, '?reg_err=success') !== false) {
    // Le paramètre est présent, afficher le contenu spécifique
    $isSuccessfulImport = true;
} else {
    // Le paramètre n'est pas présent, afficher un autre contenu ou ne rien afficher
    $isSuccessfulImport = false;
}
?>

<body>
    <section class="page-title">
        <i class="fa-solid fa-pen-to-square"></i>
        <h1>Demande d'ajout de jeu</h1>
    </section>
    
    <?php
    
    if ($isSuccessfulImport) {
        echo '<div class="flex" id="info-toast">';
        echo '<i class="fa-solid fa-check"></i>';
        echo '<p>Requête de jeu envoyée avec succès.</p>';
        echo '</div>';
    }
    
    ?>
    
    <section class="content form-add-game">
        <form action="./includes/reportGamePost.inc.php" method="post" enctype="multipart/form-data" class="flex">
            <div class="leftPartForm">
                <label for="jaquetteGame" id="jaquetteGameUploadZone">
                    <p>Ajoutez la jaquette du jeu</p>
                    <div class="button-primary" id="file-name">Importer une photo</div>
                    <p class="info-upload">Format accepté : .jpeg, .png, .gif</p>
                    <p class="info-upload">Poids Maximal : 2Mo</p>
                </label>
                <input type="file" name="jaquetteGame" id="jaquetteGame">
            </div>
            <div class="rightPartForm">
                <input type="text" name="gameName" id="gameName" placeholder="Entrez le nom de votre jeu"/>
                <textarea name="synopsisGame" id="synopsisGame" cols="30" rows="10" placeholder="Entrez le synopsis de votre jeu"></textarea>
                <input type="submit" value="Envoyer la proposition de jeu" class="button-secondary">
            </div>
        </form>
    </section>

    <script type="text/javascript">
        const toast = document.getElementById('info-toast');
        toast.addEventListener('click', function () {
            toast.style.display = 'none';
        });
    </script>
    <script src="./js/report_game_validation.js"></script>
</body>

</html>
