<?php
require_once("logica/Propietario.php");

$accion = $_POST['accion'] ?? null;

switch ($accion) {
        
    case 'eliminar':
        $p = new Propietario($_POST['id']);
        if ($p->contarApartamentos() > 0) {
            $msg = "No se puede eliminar el propietario. Tiene apartamentos asociados.";
        } else {
            $p->eliminar();
            $msg = "Propietario eliminado.";
        }
        break;
        
    default:
        $msg = "Acción no válida.";
        break;
}

header("Location: index.php?pid=" . base64_encode("presentacion/admin/leerPropietario.php") . "&mensaje=" . urlencode($msg));
exit();
