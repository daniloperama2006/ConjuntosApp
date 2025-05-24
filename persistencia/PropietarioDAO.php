<?php
class PropietarioDAO {
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    
    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
    }
    
    public function insertar() {
        return "INSERT INTO propietario (nombre, apellido, correo, clave)
            VALUES ('$this->nombre', '$this->apellido', '$this->correo', '" . $this->clave . "')";
    }
    
    public function actualizar() {
        return "UPDATE propietario
            SET nombre = '$this->nombre', apellido = '$this->apellido', correo = '$this->correo'
            WHERE id = $this->id";
    }
    
    public function eliminar() {
        return "DELETE FROM propietario WHERE id = $this->id";
    }
    
    public function consultarTodos() {
        return "SELECT id, nombre, apellido, correo FROM propietario";
    }
    
    public function consultar() {
        return "SELECT nombre, apellido, correo
                FROM propietario
                WHERE id = $this->id";
    }
    
    public function consultarInformacion() {
        return "SELECT * FROM propietario WHERE id = " . $this->id;
    }
    
    
    
    public function consultarNombre() {
        return "SELECT nombre, apellido
                FROM propietario
                WHERE id = $this->id";
    }

    public function autenticar() {
        return "SELECT id
                FROM propietario
                WHERE correo = '$this->correo' AND clave = '" . md5($this->clave) . "'";
    }
    
    public function tieneApartamentos() {
        return "SELECT COUNT(*) FROM apartamento WHERE id_propietario = " . $this->id;
    }
    
    public function consultarPorCorreo($correo) {
        return "SELECT nombre, apellido, correo FROM propietario WHERE correo = '$correo'";
    }
    
    
}
?>
