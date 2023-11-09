<?php
    session_start();
    require_once './includes/config.inc.php';

    // Assurez-vous que le paramètre id_bug existe dans l'URL
    if(isset($_GET['id_bug'])) {
        $id_bug = $_GET['id_bug'];

        // Récupérer les détails du bug
        $req_bug_details = $bdd->prepare("SELECT * FROM bug WHERE id_bug = ?");
        $req_bug_details->execute(array($id_bug));
        $bug_details = $req_bug_details->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le bug existe
        if($bug_details) {
            // Afficher les détails du bug
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | <?php echo $bug_details['nom'] ?></title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="boxtext">
                    <span><p>ID du bug : <?php echo $bug_details["id_bug"]; ?></p></span>
                    <span><p>Nom du bug : <?php echo $bug_details["nom"]; ?></p></span>
                    <span><p>Description du bug : <?php echo $bug_details["description"]; ?></p></span>
                    <span><p>Date du bug : <?php echo $bug_details["date_publication"]; ?></p></span>
                    <span><p>Likes du bug : <?php echo $bug_details["nb_likes"]; ?></p></span>
                    <span><p>Publieur du bug : <?php echo $bug_details["id_utilisateur"]; ?></p></span>
                </div>
            </div>

            <!-- Ajoutez ici le code pour afficher les commentaires et autres détails si nécessaire -->

        </div>
    </div>
</body>
</html>
<?php
        } else {
            // Rediriger ou afficher un message d'erreur si le bug n'existe pas
            header('Location: erreur_bug_inexistant.php');
            die();
        }
    } else {
        // Rediriger ou afficher un message d'erreur si id_bug n'est pas spécifié
        header('Location: erreur.php');
        die();
    }
?>
