<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Déclarer un bug</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/report-bug.css">
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

<?php
    require_once './includes/config.inc.php'; // On inclu la connexion à la bdd

    $req = $bdd->prepare("SELECT * FROM jeu");
    $req->execute();
?>

<body>
    <section class="page-title">
        <i class="fa-solid fa-pen-to-square"></i>
        <h1>Déclarer un bug</h1>
    </section>

    <?php
    
    if ($isSuccessfulImport) {
        echo '<div class="flex" id="info-toast">';
        echo '<i class="fa-solid fa-check"></i>';
        echo '<p>Bug posté avec succès</p>';
        echo '</div>';
    }
    
    ?>

    <section class="content form-add-bug">
        <form action="./includes/reportBugPost.inc.php" method="post" enctype="multipart/form-data" class="flex">
            <div class="leftPartForm">
                <div class="jaquette-game">
                    <!-- // Make the src of the image take the value of the option selected with js or php -->
                    
                </div>
            </div>
            <div class="rightPartForm">
                <select name="game" id="game">
                    <option value="0" id="no-game.png" selected disabled>Sélectionnez un jeu</option>

                    <?php
                         while($result = $req->fetch(PDO::FETCH_ASSOC)){
                    ?>
                             <option value="<?php echo $result["id_jeu"] ?>" id="<?php echo $result["image_jeu"] ?>"><?php echo $result["nom_jeu"] ?></option>
                    <?php
                         }        
                    ?>
                </select>
                <a href="./report-game.php" class="add-game-button">Vous ne trouvez pas votre jeu ? Demandez à l'ajouter sur le site !</a>
                <input type="text" name="titreBug" id="titreBug" placeholder="Donnez un titre à votre bug"/>
                <textarea name="descriptionBug" id="descriptionBug" cols="30" rows="10" placeholder="Décrivez le bug rencontré"></textarea>
                <input type="submit" value="Envoyer la proposition de jeu" class="button-secondary">
            </div>
        </form>
    </section>

    <script type="text/javascript">
        // Get the select element
        const gameSelect = document.getElementById('game');

        // Get the div where the image will be placed
        const jaquetteGame = document.querySelector('.jaquette-game');

        // Function to change the image source
        function changeImage() {
            // Get the selected option
            const selectedOption = gameSelect.options[gameSelect.selectedIndex];

            // Create a new image element
            const img = document.createElement('img');

            // Set the source of the image to the id of the selected option
            img.src = './content/img/jaquettes/' + selectedOption.id;

            // Remove any existing image in the div
            while (jaquetteGame.firstChild) {
                jaquetteGame.removeChild(jaquetteGame.firstChild);
            }

            // Add the new image to the div
            jaquetteGame.appendChild(img);
        }

        // Add an event listener to the select to call the function when the selected option changes
        gameSelect.addEventListener('change', changeImage);

        // Call the function once to set the initial image
        changeImage();
    </script>
    <script type="text/javascript">
        const toast = document.getElementById('info-toast');
        toast.addEventListener('click', function () {
            toast.style.display = 'none';
        });
    </script>
    <script src="./js/report_game_validation.js"></script>
</body>

</html>
