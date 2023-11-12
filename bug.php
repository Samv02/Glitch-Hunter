<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | <?php echo $bug_details['nom'] ?></title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/bug.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include_once './includes/navbar.inc.php'; ?>

    <?php
        require_once './includes/config.inc.php';

        // Assurez-vous que le paramètre id_bug existe dans l'URL
        if(isset($_GET['id_bug'])) {
            $id_bug = $_GET['id_bug'];

            // Récupérer les détails du bug
            $req_bug_details = $bdd->prepare("SELECT * FROM bug WHERE id_bug = ?");
            $req_bug_details->execute(array($id_bug));
            $bug_details = $req_bug_details->fetch(PDO::FETCH_ASSOC);

            $req_game_info = $bdd->prepare("SELECT * FROM jeu WHERE id_jeu = ?");
            $req_game_info->execute(array($bug_details['id_jeu']));
            $game_info = $req_game_info->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le bug existe
            if($bug_details) {
                // Afficher les détails du bug
    ?>

    <section class="page-title">
        <div>
            <h1><?php echo $bug_details['nom']; ?></h1>
            <p>Nom du jeu : <?php echo $game_info['nom_jeu']; ?></p>
        </div>
    </section>

    <section class="content game-info">
        <div class="leftpart">
            <div class="jaquette-container">
                <img src="./content/img/jaquettes/<?php echo $game_info['image_jeu']; ?>" alt="">
            </div>
            <h2><?php echo $game_info['nom_jeu']; ?></h2>
            <?php
                $req_nb_bug = $bdd->prepare("SELECT COUNT(*) AS nb_bug FROM bug WHERE id_jeu = ?");
                $req_nb_bug->execute(array($game_info['id_jeu']));
                $nb_bug = $req_nb_bug->fetch(PDO::FETCH_ASSOC);
            ?>
            <a href="./search.php?game=<?php echo $game_info['id_jeu'] ?>&search=bug">+<?php echo $nb_bug['nb_bug'] ?> autres bugs</a>
        </div>
        <div class="rightpart">
            <div class="bug-post">
                <div class="infos-post">
                    <?php 
                        $req_user_post_info = $bdd->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
                        $req_user_post_info->execute(array($bug_details['id_utilisateur']));
                        $user_post_info = $req_user_post_info->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="profil-picture-container">
                        <img src="<?php if($user_post_info['image_user']){ echo './content/img/profilPic/' . $user_post_info['image_user']; } else { echo './content/img/profilPic/profilStandard.webp'; } ?>" alt="">
                    </div>
                    <div class="post_info_user">
                        <h3><?php echo $user_post_info['pseudo']; ?></h3>
                        <p>Posté le : <?php echo $bug_details['date_publication']; ?></p>
                    </div>
                </div>
                <div class="description-bug">
                    <p><?php echo $bug_details['description']; ?></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php
        } else {
            // Rediriger ou afficher un message d'erreur si le bug n'existe pas
            header('Location: ./accueil.php');
            die();
        }
    } else {
        // Rediriger ou afficher un message d'erreur si id_bug n'est pas spécifié
        header('Location: ./accueil.php');
        die();
    }
?>
