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

<body>
    <section class="page-title">
        <i class="fa-solid fa-thumbs-up"></i>
        <h1>Mes Likes</h1>
    </section>
    <section class="content topic-list" style="margin-bottom: 100px;">
        <a href="./bug.php?id_bug=<?php echo $posts['id_bug']; ?>" class="topic">
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
        </a>
    </section>
</body>

</html>
