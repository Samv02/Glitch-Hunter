const menuProfilToggle = document.getElementById("MenuProfilToggle");
const dropdown = document.getElementById("dropdown");

let isDropdownDisplayed = false;

menuProfilToggle.addEventListener('click', function () {
    if (!isDropdownDisplayed) {
        dropdown.parentNode.classList.add('active');
        dropdown.classList.add('active');
        isDropdownDisplayed = true;
    } else {
        dropdown.parentNode.classList.remove('active');
        dropdown.classList.remove('active');
        isDropdownDisplayed = false;
    }
    
})