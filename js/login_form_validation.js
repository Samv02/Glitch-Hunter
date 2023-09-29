document.addEventListener("DOMContentLoaded", function() {
    const formulaire = document.querySelector("form");
    
    const email = document.getElementById("email");
    const errorEmailMsg = document.getElementById("errorEmailMsg");
    const password = document.getElementById("password");
    const errorPasswordMsg = document.getElementById("errorPasswordMsg");
    
    //Vérification des valeurs des inputs
    function verifyInputValues() {
        
        //Vérification de l'email
        email.addEventListener('blur', function() {
            email.classList.remove('error');
            errorEmailMsg.innerText = "";
            if(!email.value.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/g)){
                email.classList.add('error');
                errorEmailMsg.innerText = "Une forme xxxxx@xxx.xx est attendue."
            }
            if(!email.value){
                email.classList.add('error');
                errorEmailMsg.innerText = "Vous devez entrer votre mail."
            }
            if(!email.value || !email.value.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/g)){
            }
        });
        
        //Vérification du mot de passe
        password.addEventListener('blur', function() {
            password.classList.remove('error');
            errorPasswordMsg.innerText = "";
            if(!password.value){
                password.classList.add('error');
                errorPasswordMsg.innerText = "Vous devez entrer un mot de passe."
            }
        });
    }
    
    verifyInputValues();

    formulaire.addEventListener('submit', function(e) {
        if(!email.value || !password.value){
            e.preventDefault();
        }
    });
});
