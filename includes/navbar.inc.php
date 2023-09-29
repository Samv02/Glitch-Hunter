<?php 

    session_start();
    require_once './includes/config.inc.php'; // ajout connexion bdd

    if (!isset($_SESSION['user'])) {
        $user_is_logged_in = false;
    } else {
        $user_is_logged_in = true;
    }

?>

<header class="flex ai-c jc-sb">
    <img src="./content/img/logo-principal.png" alt="Logo GlitchHunter Small Svg">
    <nav class="<?php if($user_is_logged_in){ echo 'user_is_logged_in'; } ?>">
        <a href="./contact.php" title="Contact">Contact</a>
        <a href="./login.php" title="Connexion" id="loginNavButton">Connexion</a>
        <a href="./login.php" title="Connexion" id="registerNavButton">Inscription</a>
        <div class="nav-menu--wrapper">
            <div class="profilPic--wrapper flex ai-c icon-space rounded-border" id="MenuProfilToggle">
                <img id="profile-image" src="./content/profilPic/dsgjohnson.webp" alt="Photo de profil">
                <i class="fas fa-caret-up icone-blanche"></i>
            </div>        
            <div class="dropdown-menu" id="dropdown">
                <a href="#"><i class="fas fa-edit"></i> Mes posts</a>
                <a href="#"><i class="fas fa-thumbs-up"></i> Mes likes</a>
                <a href="#"><i class="fas fa-history"></i> Mon historique</a>
                <a href="#"><i class="fas fa-cogs"></i> Paramètres</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </nav>
    <script src="./js/nav_profil_menu.js"></script>
</header>