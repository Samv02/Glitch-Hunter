<?php 
    require_once 'config.inc.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['gameName']) && !empty($_POST['synopsisGame']))
    {
        $gameName = htmlspecialchars($_POST['gameName']);
        $synopsisGame = htmlspecialchars($_POST['synopsisGame']);
        
        $check = $bdd->prepare('SELECT nom_jeu FROM jeu WHERE nom_jeu = ?');
        $check->execute(array($gameName));
        $data = $check->fetch();
        $row = $check->rowCount();

        if (isset($_FILES["jaquetteGame"]) && $_FILES["jaquetteGame"]["error"] === UPLOAD_ERR_OK) {
            $target_dir = "../content/img/jaquettes/";
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES["jaquetteGame"]["name"], PATHINFO_EXTENSION));

            // Vérifier si le fichier est une image
            $allowedFileTypes = array("image/jpeg", "image/png", "image/gif");
            if (!in_array($_FILES["jaquetteGame"]["type"], $allowedFileTypes)) {
                echo "Seules les images au format JPEG, PNG et GIF sont autorisées.";
                $uploadOk = 0;
            }

            // Limiter la taille du fichier (2 Mo)
            $maxFileSize = 2 * 1024 * 1024; // 2 Mo
            if ($_FILES["jaquetteGame"]["size"] > $maxFileSize) {
                echo "Le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo.";
                $uploadOk = 0;
            }

            // Générer un nom de fichier unique basé sur le timestamp
            $timestamp = time();
            $newFileName = $timestamp . "." . $imageFileType;

            $target_file = $target_dir . $newFileName;

            // Nettoyer le nom de fichier
            $newFileName = htmlspecialchars($newFileName);

            // Vérifier si $uploadOk est à 0 (une erreur s'est produite) ou si tout est correct, puis télécharger le fichier
            if ($uploadOk == 0) {
                echo "Désolé, votre fichier n'a pas été téléchargé.";
            } else {
                if (move_uploaded_file($_FILES["jaquetteGame"]["tmp_name"], $target_file)) {
                    echo "Le fichier " . $newFileName . " a été téléchargé.";
                    // Vous pouvez maintenant enregistrer le nom du fichier dans votre base de données.
                } else {
                    echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
                }
            }
        } else { $newFileName = ''; }


        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            $insert = $bdd->prepare('INSERT INTO verification_jeu(nom_jeu_a_valider, image_jeu_a_valider, synopsis_jeu_a_valider) VALUES(:nom_jeu, :image_jeu, :synopsis_jeu)');
            $insert->execute(array(
                'nom_jeu' => $gameName,
                'synopsis_jeu' => $synopsisGame,
                'image_jeu' => $newFileName
            ));
            header('Location:../login.php?reg_err=success');
            die();
        }else{ header('Location: ../register.php?reg_err=already'); die();}
    }