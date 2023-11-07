

jaquetteGame.addEventListener('change', function (event) {
    const selectedFile = event.target.files[0]; 
    jaquetteGame.classList.remove('error');
    isErrors = false;
    if (selectedFile) {
        //Vérifier le type de fichier
        const acceptedFileType = ["image/jpeg", "image/png", "image/gif"];
        if(!acceptedFileType.includes(selectedFile.type)){
            jaquetteGame.classList.add('error');
            isErrors = true;
        } else {
            document.getElementById('file-name').innerText = selectedFile.name;
        }
    } else {
        document.getElementById('file-name').innerText = "Sélectionnez un fichier";
    }
});