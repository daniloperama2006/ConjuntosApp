<?php 

class UserDAO{
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
        return "select id_usuario, id_rol
                from Usuario
                where correo = '" . $this -> correo . "' and clave = '" . md5($this -> clave) . "'";
    }
    
    public function consultar(){
        return "select nombre, apellido, correo
                from Usuario
                where id_usuario = '" . $this -> idUsuario . "'";
    }

} 

?>