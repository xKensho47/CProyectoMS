<!--VENTANA EMERGENTE --->

<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-3" id="eliminaModalLabel"> Estas seguro que deseas eliminar a este Usuario ? </h1>
                <button type="button" class="btn-close btn-color" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body fs-5">

                <form action="eliminar_usuario.php" method="post">
                    <div class="">
                        <input type="hidden" name="id_usuario" id="id_usuario_eliminar" class="form-control fs-5">
                        <button type="submit" class="btn guardar fs-5" > Si </button>
                        <button type="button" class="btn salir fs-5" data-bs-dismiss="modal"> No </button>
                    </div>
                </form>
               
            </div>

        </div>
    </div>
</div>