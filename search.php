<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlitchHunter | Search</title>
    <link rel="shortcut icon" href="./content/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/search.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<?php include_once './includes/navbar.inc.php'; ?>

<body>
    <?php
        require_once './includes/config.inc.php';

        if (isset($_GET['search']) && isset($_GET['game'])) {
            $searching = true;
        } else {
            $searching = false;
        }
    ?>

    <section class="page-title">
        <?php if ($searching) { ?>
            <h1>Résultats de recherche</h1>
        <?php } ?>
        <?php if (!$searching) { ?>
            <h1>Liste des bugs</h1>
        <?php } ?>
        
        <?php
            $req_select = $bdd->prepare("SELECT * FROM jeu");
            $req_select->execute();
        ?>
        <div class="content searchbar">
            <form action="" class="flex">
                <select name="game" id="game">
                    <option value="0" id="no-game.png" selected disabled>Sélectionnez un jeu</option>
                    <?php
                        while($result = $req_select->fetch(PDO::FETCH_ASSOC)){
                            $selected = isset($_GET['game']) && $_GET['game'] == $result["id_jeu"] ? 'selected' : '';
                    ?>
                        <option value="<?php echo $result["id_jeu"] ?>" id="<?php echo $result["image_jeu"] ?>" <?php echo $selected; ?>><?php echo $result["nom_jeu"] ?></option>
                    <?php
                        }        
                    ?>
                </select>
                <input type="text" name="search" id="search" placeholder="Décrivez le bug que vous rencontrez..." value="<?php if (isset($_GET['search'])) {
                    echo $_GET['search'];
                } ?>">
                <input type="submit" value="Rechercher">
            </form>
        </div>
    </section>
    
    <?php if($searching) { ?>
        <section class="content result-list">
            <?php
                if (isset($_GET['game']) && isset($_GET['search'])) {
                    $req_search = $bdd->prepare("SELECT * FROM bug WHERE id_jeu = ? AND description LIKE ? ORDER BY date_publication");
                    $req_search->execute(array($_GET['game'], '%' . $_GET['search'] . '%'));
                    $result_search = $req_search->fetch(PDO::FETCH_ASSOC);
                }
    
                if (isset($_GET['game'])) {
                    $req_game_title = $bdd->prepare("SELECT nom_jeu FROM jeu WHERE id_jeu = ?");
                    $req_game_title->execute(array($_GET['game']));
                    $result_game_title = $req_game_title->fetch(PDO::FETCH_ASSOC);
                }
            ?>
    
            <h2>Résultats pour : <span class="bold"><?php echo $_GET['search']; ?></span> dans le jeu : <span class="bold"><?php echo $result_game_title['nom_jeu']; ?></span></h2>
            <?php
            if ($result_search) {
                while ($result = $result_search->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <a href="./bug.php?id_bug=<?php echo $result['id_bug']; ?>" class="topic">
                        <div class="content-topic">
                            <div class="title-topic">
                                <?php echo $result['nom']; ?>
                            </div>
                            <div class="game-topic">
                                <p>
                                    Jeu : <?php
                                    $req_game = $bdd->prepare("SELECT nom_jeu FROM jeu WHERE id_jeu = ?");
                                    $req_game->execute(array($result['id_jeu']));
                                    $game_result = $req_game->fetch(PDO::FETCH_ASSOC);
                                    echo $game_result['nom_jeu'];
                                    ?>
                                </p>
                            </div>
                            <div class="description-topic">
                                <?php echo $result['description']; ?>
                            </div>
                        </div>
                        <div class="likes-topic">
                            Nb. Likes : <?php echo $result['nb_likes']; ?>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo "<p class='no-results'>Aucun résultat trouvé.</p>";
            }
            ?>
        </section>
        <section class="content result-game-list">
            <h2>Résultats pour le jeu : <span class="bold"><?php echo $result_game_title['nom_jeu']; ?></span></h2>
            
            <?php
                $req_search2 = $bdd->prepare("SELECT * FROM bug WHERE id_jeu = ? ORDER BY date_publication");
                $req_search2->execute(array($_GET['game']));
                $results_search2 = $req_search2->fetchAll(PDO::FETCH_ASSOC);
    
                if ($results_search2) {
                    foreach ($results_search2 as $result2) {
            ?>
                    <a href="./bug.php?id_bug=<?php echo $result2['id_bug']; ?>" class="topic">
                        <div class="content-topic">
                            <div class="title-topic">
                                <?php echo $result2['nom']; ?>
                            </div>
                            <div class="game-topic">
                                <p>
                                    Jeu : <?php
                                    $req_game = $bdd->prepare("SELECT nom_jeu FROM jeu WHERE id_jeu = ?");
                                    $req_game->execute(array($result2['id_jeu']));
                                    $game_result2 = $req_game->fetch(PDO::FETCH_ASSOC);
                                    echo $game_result2['nom_jeu'];
                                    ?>
                                </p>
                            </div>
                            <div class="description-topic">
                                <?php echo $result2['description']; ?>
                            </div>
                        </div>
                        <div class="likes-topic">
                            Nb. Likes : <?php echo $result2['nb_likes']; ?>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo "<p>Aucun résultat trouvé.</p>";
            }
            ?>
        </section>
    <?php } ?>

    <?php if(!$searching) { ?>
        <section class="content all-result" style="margin-bottom: 75px;">
            <?php
                $req_all_bug = $bdd->prepare("SELECT * FROM bug ORDER BY date_publication");
                $req_all_bug->execute();
                $results_all_bug = $req_all_bug->fetchAll(PDO::FETCH_ASSOC);
    
                if ($results_all_bug) {
                    foreach ($results_all_bug as $result_all_bug) {
            ?>
                    <a href="./bug.php?id_bug=<?php echo $result_all_bug['id_bug']; ?>" class="topic">
                        <div class="content-topic">
                            <div class="title-topic">
                                <?php echo $result_all_bug['nom']; ?>
                            </div>
                            <div class="game-topic">
                                <p>
                                    Jeu : <?php
                                    $req_game = $bdd->prepare("SELECT nom_jeu FROM jeu WHERE id_jeu = ?");
                                    $req_game->execute(array($result_all_bug['id_jeu']));
                                    $game_result3 = $req_game->fetch(PDO::FETCH_ASSOC);
                                    echo $game_result3['nom_jeu'];
                                    ?>
                                </p>
                            </div>
                            <div class="description-topic">
                                <?php echo $result_all_bug['description']; ?>
                            </div>
                        </div>
                        <div class="likes-topic">
                            Nb. Likes : <?php echo $result_all_bug['nb_likes']; ?>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo "<p>Aucun résultat trouvé.</p>";
            }
            ?>
        </section>
    <?php } ?>

    <section class="all-result-button">
        <h3>
            Envie de voir la liste complète ?
        </h3>
        <a href="./search.php" class="button-primary">
            Voir tous les bugs
        </a>
    </section>
</body>

</html>
