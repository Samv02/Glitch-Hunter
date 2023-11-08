<?php 
    require_once 'config.inc.php'; // On inclu la connexion à la bdd

    session_start();

    //Vérifier si l'utilisateur est connecté et récupérer son id via le token conservé dans la session, sinon le rediriger vers login.php
    if(isset($_SESSION['user'])){
        $check = $bdd->prepare('SELECT id_utilisateur FROM utilisateurs WHERE token = ?');
        $check->execute(array($_SESSION['user']));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1){
            $id_utilisateur = $data['id_utilisateur'];
        }else header('Location: ../login.php');

    }else header('Location: ../login.php');

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['titreBug']) && !empty($_POST['descriptionBug'] && !empty($_POST['game']))){
        // On nettoie les données envoyées
        $titreBug = htmlspecialchars($_POST['titreBug']);
        $descriptionBug = htmlspecialchars($_POST['descriptionBug']);
        $game = htmlspecialchars($_POST['game']);

        // On vérifie si le jeu existe
        $check = $bdd->prepare('SELECT nom_jeu FROM jeu WHERE id_jeu = ?');
        $check->execute(array($game));
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si le jeu existe
        if($row == 1){
            // On vérifie si l'utilisateur n'a pas déjà déclaré ce bug
            $check = $bdd->prepare('SELECT nom FROM bug WHERE nom = ?');
            $check->execute(array($titreBug));
            $data = $check->fetch();
            $row = $check->rowCount();

            // Si le bug n'existe pas
            if($row == 0){
                // On insert dans la base de données
                $insert = $bdd->prepare('INSERT INTO bug(nom, description, id_jeu, id_utilisateur) VALUES(:nom, :description, :id_jeu, :id_utilisateur)');
                $insert->execute(array(
                    'nom' => $titreBug,
                    'description' => $descriptionBug,
                    'id_jeu' => $game,
                    'id_utilisateur' => $id_utilisateur
                ));
                header('Location:../report-bug.php?reg_err=success');
                die();
            }else{ header('Location: ../report-bug.php?reg_err=already'); die(); }
        }else{ header('Location: ../report-bug.php?reg_err=game'); die(); }
    }