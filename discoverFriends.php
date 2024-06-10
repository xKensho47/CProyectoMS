<?php
session_start();
include('conexion.php');
include('CProfile.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 9;

    $profile = new CProfile($conexion);
    $profile->discoverFriends($page, $itemsPerPage);
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
