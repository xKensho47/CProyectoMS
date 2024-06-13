<?php
include("conexion.php");
if(!isset($_SESSION['id_cuenta'])){
  header("Location: index.php");
}

$id_cuenta = $_SESSION['id_cuenta'];
$id_peli = $_GET['id_peli'];

$q = " SELECT 
    cu.id_cuenta as id_cuenta_amigo,
    cu.nombre_usuario,
    cu.id_img
FROM 
    lista_amigos la
JOIN 
    cuenta_usuario cu
ON 
    la.amigo = cu.id_cuenta
WHERE 
    la.id_cuenta = $id_cuenta";
$resultado = mysqli_query($conexion,$q);


?>


<!-- Modal -->
<div class="modal fade" id="modalRecomendarPeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content recomendar-peli-content">
      <div class="modal-header recomendar-peli-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Recomendar a un amigo</h1>
      </div>
      <div class="modal-body">
          <div class="modal-body-amigos">
          <?php
            if ($resultado->num_rows > 0) {
                while ($listado_amigos = $resultado->fetch_assoc()) {
                  echo '
                  <form action="recomendar_peli.php?form_submitted=true" method="post" class="contenedor-amigo">
                    <input type="hidden" name="pelicula_id" value="' . $id_peli . '">
                    <input type="hidden" name="usuario_id" value="' . $id_cuenta . '">
                    <input type="hidden" name="amigo_id" value="' . $listado_amigos["id_cuenta_amigo"] . '">
                    <div class="amigo-imagen">
                        <img src="' . $listado_amigos["id_img"] . '" alt="' . $listado_amigos["nombre_usuario"] . '">
                    </div>
                    <div class="amigo-nombre">
                        <h2>' . $listado_amigos["nombre_usuario"] . '</h2>
                        <button type="submit" class="amigo-enviar">Enviar</button>
                    </div>
                  </form>
                        
                    ';
                }
            } else {
                echo '';
            }
          ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>