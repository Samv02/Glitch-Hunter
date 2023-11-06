<?php 

    session_start();
    require_once './includes/config.inc.php'; // ajout connexion bdd

    if (!isset($_SESSION['user'])) {
        $user_is_logged_in = false;
    } else {
        $user_is_logged_in = true;
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();
        
        if (!isset($_REQUEST['action'])) {
            $_REQUEST['action'] = 0;
        }
        
        if ($_REQUEST["action"] == '10') {
            session_destroy();
            header('Location: ./accueil.php');
        }
    } 




?>

<header class="flex ai-c jc-sb">
    <img src="./content/img/logo-principal.png" alt="Logo GlitchHunter Small Svg">
    <nav class="<?php if($user_is_logged_in){ echo 'user_is_logged_in'; }?>">
        <a href="./contact.php" title="Contact">Contact</a>
        <a href="./login.php" title="Connexion" id="loginNavButton">Connexion</a>
        <a href="./register.php" title="Inscription" id="registerNavButton">Inscription</a>
        <div class="nav-menu--wrapper">
            <div class="profilPic--wrapper flex ai-c icon-space rounded-border" id="MenuProfilToggle">
                <img id="profile-image" src="<?php if($data['image_user'] > 0){ echo $data['image_user']; } else { echo './content/profilPic/profilStandard.webp'; } ?>" alt="Photo de profil">
                <i class="fas fa-caret-up icone-blanche"></i>
            </div>        
            <div class="dropdown-menu" id="dropdown">
                <a href="#"><i class="fas fa-edit"></i> Mes posts</a>
                <a href="#"><i class="fas fa-thumbs-up"></i> Mes likes</a>
                <a href="#"><i class="fas fa-history"></i> Mon historique</a>
                <a href="#"><i class="fas fa-cogs"></i> Paramètres</a>
                <a href="./accueil.php?action=10"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </nav>
    <script src="./js/nav_profil_menu.js"></script>
</header>