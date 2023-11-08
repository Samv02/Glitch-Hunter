<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Home</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<?php include_once './includes/navbar.inc.php'; ?>

<?php

// On inclu la connexion à la bdd
require_once './includes/config.inc.php';

//Vérifier si l'utilisateur est connecté et récupérer son id via le token conservé dans la session, sinon le rediriger vers login.php
if (isset($_SESSION['user'])) {
    $check = $bdd->prepare('SELECT id_utilisateur FROM utilisateurs WHERE token = ?');
    $check->execute(array($_SESSION['user']));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row == 1) {
        $id_utilisateur = $data['id_utilisateur'];
    } else header('Location: ./login.php');
} else header('Location: ./login.php');

//Récupérer un tableau contenant les posts de l'utilisateur
$req_bug = $bdd->prepare("SELECT * FROM bug WHERE id_utilisateur = ?");
$req_bug->execute(array($id_utilisateur));

?>

<body>
    <section class="page-title">
        <i class="fa-solid fa-pen-to-square"></i>
        <h1>Mes Post</h1>
    </section>
    <section class="content topic-list"> 
        
        <?php
                while($posts = $req_bug->fetch(PDO::FETCH_ASSOC)){
        ?>
            <div class="topic">
                <div class="content-topic">
                    <div class="title-topic">
                        <?php echo $posts['nom'] ?>
                    </div>
                    <div class="game-topic">
                        <p>
                            Jeu : <?php 
                            $req_game = $bdd->prepare("SELECT nom_jeu FROM jeu WHERE id_jeu = ?");
                            $req_game->execute(array($posts['id_jeu']));
                            $result = $req_game->fetch(PDO::FETCH_ASSOC);
                            echo $result['nom_jeu'];
                            ?>
                        </p>
                    </div>
                    <div class="description-topic">
                        <?php echo $posts['description'] ?>
                    </div>
                </div>
                <div class="likes-topic">
                    Nb. Likes : <?php echo $posts['nb_likes'] ?>
                </div>
            </div>
        <?php
                }        
        ?>
    </section>
</body>

</html>
