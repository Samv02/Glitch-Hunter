<?php 
    require_once 'config.inc.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['verifyPassword']))
    {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['verifyPassword']);
        $passwordHash = hash('sha256', $password);
        
        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Vérifier si le fichier a été correctement téléchargé
        if (isset($_FILES["profilPic"]) && $_FILES["profilPic"]["error"] === UPLOAD_ERR_OK) {
            // AJOUT DE LA PHOTO DE PROFIL EN BDD AU REGISTER
            $target_dir = "../content/img/profilPic/";
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES["profilPic"]["name"], PATHINFO_EXTENSION));

            // Vérifier si le fichier est une image
            $allowedFileTypes = array("image/jpeg", "image/png", "image/gif");
            if (!in_array($_FILES["profilPic"]["type"], $allowedFileTypes)) {
                echo "Seules les images au format JPEG, PNG et GIF sont autorisées.";
                $uploadOk = 0;
            }

            // Limiter la taille du fichier (2 Mo)
            $maxFileSize = 2 * 1024 * 1024; // 2 Mo
            if ($_FILES["profilPic"]["size"] > $maxFileSize) {
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
                if (move_uploaded_file($_FILES["profilPic"]["tmp_name"], $target_file)) {
                    echo "Le fichier " . $newFileName . " a été téléchargé.";
                    // Vous pouvez maintenant enregistrer le nom du fichier dans votre base de données.
                } else {
                    echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
                }
            }
        } else { $newFileName = ''; }


        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($username) <= 100){ // On verifie que la longueur du pseudo <= 100
                if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($password === $password_retype){ // si les deux mdp saisis sont bon

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            //$cost = ['cost' => 12];
                            //$password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                            $ip = $_SERVER['REMOTE_ADDR']; 
                             /*
                              ATTENTION
                              Verifiez bien que le champs token est présent dans votre table utilisateurs, il a été rajouté APRÈS la vidéo
                              le .sql est dispo pensez à l'importer ! 
                              ATTENTION
                            */
                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(type, pseudo, email, password, token, image_user) VALUES(:type, :pseudo, :email, :password, :token, :image_user)');
                            $insert->execute(array(
                                'type' => "user",
                                'pseudo' => $username,
                                'email' => $email,
                                'password' => $passwordHash,
                                // 'ip' => $ip,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                                'image_user' => $newFileName
                            ));
                            // On redirige avec le message de succès
                            header('Location:../login.php?reg_err=success');
                            die();
                        }else{ header('Location: ../register.php?reg_err=password'); die();}
                    }else{ header('Location: ../register.php?reg_err=email'); die();}
                }else{ header('Location: ../register.php?reg_err=email_length'); die();}
            }else{ header('Location: ../register.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: ../register.php?reg_err=already'); die();}
    }