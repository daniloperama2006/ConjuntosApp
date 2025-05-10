<?php
require_once __DIR__ . "/../persistencia/UserDAO.php";
require_once __DIR__ . "/../persistencia/Conexion.php";
class Usuario{
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $idRol;

    public function __construct($idUsuario = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $idRol = 0) {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->idRol = $idRol;
    }

    public function autenticar(){
        $conexion = new Conexion();
        $userDAO = new UserDAO("","","", $this -> correo, $this -> clave);
        $conexion -> abrir();
        $conexion -> ejecutar($userDAO -> autenticar());
        if($conexion -> filas() == 1){            
            $resultado = $conexion -> registro();
            $this -> idUsuario = $resultado[0];
            $this -> idRol = $resultado[1];
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }
    }

    public function consultar(){
        $conexion = new Conexion();
        $userDAO = new userDAO($this -> idUsuario);
        $conexion -> abrir();
        $conexion -> ejecutar($userDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> correo = $datos[2];
        $conexion->cerrar();
    }


    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function getIdRol(): int
    {
        return $this->idRol;
    }
}

?>