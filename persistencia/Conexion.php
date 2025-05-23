<?php
class Conexion{
    private $conexion;
    private $resultado;
    
    public function abrir(){
        $this -> conexion = new mysqli("localhost", "root", "", "conjunto", 3306);
    }
    
    public function cerrar(){
        $this -> conexion -> close();
    }
    
    public function ejecutar($sentencia){
        $this -> resultado = $this -> conexion -> query($sentencia);
    }
    
    public function registro(){
        return $this -> resultado -> fetch_row();
    }
    
    public function filas(){
        return $this -> resultado -> num_rows;
    }
    
    public function ejecutarConsulta($sentencia){
        $resultado = $this->conexion->query($sentencia);
        if (!$resultado) {
            echo "Error en consulta: " . $this->conexion->error;
            return false;
        }
        return $resultado;
    }
    
}
?>
