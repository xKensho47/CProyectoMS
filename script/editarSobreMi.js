document.getElementById('modifAboutMeCheckbox').addEventListener('change', function() {
    var aboutMeRead = document.getElementById('aboutMeRead');
    var aboutMeMod = document.getElementById('aboutMeMod');
    if (this.checked) {
        aboutMeRead.classList.add('d-none');
        aboutMeMod.classList.remove('d-none');
        aboutMeMod.removeAttribute('readonly');
    } else {
        aboutMeRead.classList.remove('d-none');
        aboutMeMod.classList.add('d-none');
        aboutMeMod.setAttribute('readonly', 'readonly');
    }
});