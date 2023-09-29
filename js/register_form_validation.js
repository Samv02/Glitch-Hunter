document.addEventListener("DOMContentLoaded", function() {
    const formulaire = document.querySelector("form");
    
    const username = document.getElementById("username");
    const errorUsernameMsg = document.getElementById("errorUsernameMsg");
    const email = document.getElementById("email");
    const errorEmailMsg = document.getElementById("errorEmailMsg");
    const password = document.getElementById("password");
    const errorPasswordMsg = document.getElementById("errorPasswordMsg");
    const verifyPassword = document.getElementById("verifyPassword");
    const errorVerifyPasswordMsg = document.getElementById("errorVerifyPasswordMsg");
    const profilPic = document.getElementById("profilPic");
    
    let isErrors = false;

    //Vérification des valeurs des inputs
    function verifyInputValues() {
        
        //Vérification des valeurs des inputs
        username.addEventListener('blur', function() {
            username.classList.remove('error');
            errorUsernameMsg.innerText = "";
            isErrors = false;
            if(!username.value){
                username.classList.add('error');
                errorUsernameMsg.innerText = "Vous devez entrer votre prénom.";
                isErrors = true;
            }
        });
        
        //Vérification de l'email
        email.addEventListener('blur', function() {
            email.classList.remove('error');
            errorEmailMsg.innerText = "";
            isErrors = false;
            if(!email.value.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/g)){
                email.classList.add('error');
                errorEmailMsg.innerText = "Une forme xxxxx@xxx.xx est attendue."
            }
            if(!email.value){
                email.classList.add('error');
                errorEmailMsg.innerText = "Vous devez entrer votre mail."
            }
            if(!email.value || !email.value.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/g)){
                isErrors = true;
            }
        });
        
        //Vérification du mot de passe
        password.addEventListener('blur', function() {
            password.classList.remove('error');
            errorPasswordMsg.innerText = "";
            isErrors = false;
            if(!password.value){
                password.classList.add('error');
                errorPasswordMsg.innerText = "Vous devez entrer un mot de passe."
                isErrors = true;
            }
        });
        
        //Vérification de la vérification du mot de passe
        verifyPassword.addEventListener('blur', function() {
            verifyPassword.classList.remove('error');
            errorVerifyPasswordMsg.innerText = "";
            isErrors = false;
            if(!verifyPassword.value){
                verifyPassword.classList.add('error');
                errorVerifyPasswordMsg.innerText = "Vous devez vérifier votre mot de passe."
                isErrors = true;
            }
            if(password.value != verifyPassword.value && password.value && verifyPassword.value){
                verifyPassword.classList.add('error');
                errorVerifyPasswordMsg.innerText = "Les mots de passe ne correspondent pas."
                isErrors = true;
            }
        });
        
        //Vérification de l'upload de l'image
        profilPic.addEventListener('change', function (event) {
            const selectedFile = event.target.files[0]; 
            profilPic.classList.remove('error');
            errorProfilPicMsg.innerText = "";
            isErrors = false;
            if (selectedFile) {
                //Vérifier le type de fichier
                const acceptedFileType = ["image/jpeg", "image/png", "image/gif"];
                if(!acceptedFileType.includes(selectedFile.type)){
                    profilPic.classList.add('error');
                    errorProfilPicMsg.innerText = "Le fichier doit être une image de type jpg, png ou gif."
                    document.getElementById('profilPicUploadZone').style.backgroundColor = "#f5cdcd";
                    document.getElementById('profilPicUploadZone').style.borderColor = "red";
                    isErrors = true;
                } else {
                    document.getElementById('file-name').innerText = selectedFile.name;
                }
            } else {
                document.getElementById('file-name').innerText = "Sélectionnez un fichier";
            }
        });
    }
    
    verifyInputValues();

    formulaire.addEventListener('submit', function(e) {
        console.log(isErrors);
        if(isErrors || !username.value || !email.value || !password.value || !verifyPassword.value){
            console.log('hello');
            e.preventDefault();
        }
    });
});
