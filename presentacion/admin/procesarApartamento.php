<?php
require_once("logica/Apartamento.php");

$accion = $_POST['accion'] ?? null;

switch ($accion) {
    case 'crear':
        $a = new Apartamento( $_POST['numero'], $_POST['id_propietario']);
        $a->insertar();
        $msg = "Apartamento creado correctamente.";
        header("Location: index.php?pid=" . base64_encode("presentacion/admin/crearApartamento.php") . "&mensaje=" . urlencode($msg));
        exit();
        break;

    case 'actualizar':
        $a = new Apartamento($_POST['id'], $_POST['numero'], $_POST['id_propietario']);
        $a->actualizar();
        $msg = "Apartamento actualizado.";
        break;

    case 'eliminar':
        $a = new Apartamento($_POST['id']);
        $a->eliminar();
        $msg = "Apartamento eliminado.";
        break;

    default:
        $msg = "Acción inválida.";
        break;
}

