<?php
require_once("logica/Propietario.php");

$accion = $_POST['accion'] ?? null;

switch ($accion) {
    case 'crear':
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['clave'])) {
            $p = new Propietario("", $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['clave']);
            $p->insertar();
        } 
        break;
        
    case 'actualizar':
        $p = new Propietario($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['correo']);
        $p->actualizar();
        break;
        
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
