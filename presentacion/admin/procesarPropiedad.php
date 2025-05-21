<?php
require_once("logica/Apartamento.php");

$accion = $_POST['accion'] ?? null;

switch ($accion) {
    case 'crear':
        $a = new Apartamento("", $_POST['numero'], 0, $_POST['propietario']);
        $a->insertar();
        $msg = "Apartamento creado correctamente.";
        break;

    case 'actualizar':
        $a = new Apartamento($_POST['id'], $_POST['numero'], 0, $_POST['propietario']);
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

header("Location: index.php?pid=" . base64_encode("presentacion/admin/leerPropiedad.php") . "&mensaje=" . urlencode($msg));
exit();
