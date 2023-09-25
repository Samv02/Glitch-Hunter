document.addEventListener("DOMContentLoaded", function() {
    const formulaire = document.querySelector("form");
    const name = document.getElementById("name");
    const surname = document.getElementById("surname");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const profilPic = document.getElementById("profilPic");
    const submitButton = document.getElementById("submitButton");

    let formValid = true;

    function verifyInputValues() {
        name.addEventListener('blur', function() {
            formValid = true;
            name.classList.remove('error');
            nameErrorMsg.innerText = "";
            if(!name.value){
                name.classList.add('error');
                nameErrorMsg.innerText = "Vous devez entrer votre prénom."
                formValid = false;
            }
        });
        surname.addEventListener('blur', function() {
            formValid = true;
            surname.classList.remove('error');
            surnameErrorMsg.innerText = "";
            if(!surname.value){
                surname.classList.add('error');
                surnameErrorMsg.innerText = "Vous devez entrer votre nom."
                formValid = false;
            }
        });
        email.addEventListener('blur', function() {
            formValid = true;
            email.classList.remove('error');
            emailErrorMsg.innerText = "";
            if(!email.value){
                email.classList.add('error');
                emailErrorMsg.innerText = "Vous devez entrer votre email."
                formValid = false;
            }
            
            if(!email.value.includes("@")){
                email.classList.add('error');
                emailErrorMsg.innerText = "Votre email doit être de la forme : ......@.......fr"
                formValid = false;
            }
        });
        password.addEventListener('blur', function() {
            password.classList.remove('error');
            passwordErrorMsg.innerText = "";
            if(!password.value){
                password.classList.add('error');
                passwordErrorMsg.innerText = "Vous devez entrer un mot de passe."
                formValid = false;
            }
            if(password.value == confirmPassword.value){
                confirmPassword.classList.remove('error');
                confirmPasswordErrorMsg.innerText = "";
                formValid = false;
            }
            if(password.value != confirmPassword.value){
                password.classList.add('error');
                confirmPassword.classList.add('error');
                confirmPasswordErrorMsg.innerText = "Vos mots de passe ne correspondent pas."
                formValid = false;
            }
            formValid = true;
        });
        confirmPassword.addEventListener('blur', function() {
            if(password.value){
                password.classList.remove('error');
                confirmPassword.classList.remove('error');
                confirmPasswordErrorMsg.innerText = "";
            }
            if(password.value != confirmPassword.value){
                password.classList.add('error');
                confirmPassword.classList.add('error');
                confirmPasswordErrorMsg.innerText = "Vos mots de passe ne correspondent pas."
                formValid = false;
            }
            formValid = true;
        });
    }
    
    verifyInputValues();

    formulaire.addEventListener('submit', function(e) {
        console.log('hello')
        if(!verifyInputValues()){
            console.log(verifyInputValues);
            e.preventDefault();
        }
    });
});
