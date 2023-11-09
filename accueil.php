<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Home</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<?php include_once './includes/navbar.inc.php'; ?>

<body>
    <img src="./content/img/logo-principal.png" alt="Logo GlitchHunter Large Svg" class="logoTop" />
    <h1>Rencontrez-vous des difficultés pendant vos sessions de jeu ? Vous êtes au bon endroit pour trouver des solutions !</h1>
    <div class="centered-button">
        <a href="./report-bug.php" class="butonTop button-primary">SIGNALER UN BUG</a>
    </div>

    <section class="content searchbar">
        <form action="" class="flex">
            <select name="game" id="game">
                <option value="minecraft">Minecraft</option>
                <option value="leagueoflegends">League Of Legends</option>
            </select>
            <input type="text" name="serach" id="search" placeholder="Décrivez le bug que vous rencontrez...">
            <input type="submit" value="Rechercher">
        </form>
    </section>

    <?php
        //Récupérer un tableau contenant les posts de l'utilisateur
        $req_bug = $bdd->prepare("SELECT * FROM bug ORDER BY nb_likes DESC LIMIT 5");
        $req_bug->execute(); 
    ?>
    <section class="content subjects trending-subjects">
        <div class="flex subject-selectors">
            <div class="selector trending-topics">
                Sujets populaires
            </div>
            <div class="selector recent-topics">
                Sujets récents
            </div>
        </div>
        <?php
                while($posts = $req_bug->fetch(PDO::FETCH_ASSOC)){
        ?>
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
        <?php
                }        
        ?>
    </section>

    <?php
        //Récupérer un tableau contenant les posts de l'utilisateur
        $req_bug = $bdd->prepare("SELECT * FROM bug ORDER BY date_publication DESC LIMIT 5");
        $req_bug->execute(); 
    ?>
    <section class="content subjects recent-subjects">
        <div class="flex subject-selectors">
            <div class="selector recent-topics">
                Sujets récents
            </div>
            <div class="selector trending-topics">
                Sujets populaires
            </div>
        </div>
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
