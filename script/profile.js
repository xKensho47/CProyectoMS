document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#editaModal"]');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const editaModal = document.getElementById('editaModal');
            const id = this.getAttribute('data-bs-id');

            let inputId = editaModal.querySelector('.modal-body #id');
            let inputAvatar = editaModal.querySelector('.modal-body #avatar');
            let inputNombreUsuario = editaModal.querySelector('.modal-body #nombre_usuario');
            let inputMail = editaModal.querySelector('.modal-body #mail');
            let inputContrasena = editaModal.querySelector('.modal-body #contraseña');

            let url = "profile_data.php";
            let formData = new FormData();
            formData.append('id', id);

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
                .then(data => {
                    inputId.value = data.id_cuenta;
                    inputAvatar.value = data.id_img;
                    inputNombreUsuario.value = data.nombre_usuario;
                    inputMail.value = data.mail;
                    inputContrasena.value = data.contraseña;
                }).catch(err => console.log(err));
        });
    });
});
