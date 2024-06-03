<?php
function verification() {
    if (isset($_SESSION['id_cuenta'])) {
        // Sesión está iniciada
        return true;
    } else {
        // Sesión no iniciada
        return false;
    }
}
?>
