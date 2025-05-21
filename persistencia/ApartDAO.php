<?php
class ApartDAO{
    private $idApartamento;
    private $numero;
    private $bloque;
    private $idPropietario;
    
    public function __construct($idApartamento = 0, $numero = 0, $bloque = 0, $idPropietario = 0) {
        $this -> idApartamento = $idApartamento;
        $this -> numero = $numero;
        $this -> bloque = $bloque;
        $this -> idPropietario = $idPropietario;
    }
    
    public function consultarPorPropietario($idPropietario){
        return "select a.id_apartamento , a.numero, a.id_propietario, u.nombre, u.apellido
                from apartamento a join propietario u on (a.id_propietario = u.id_usuario)
                where a.id_propietario = 3";
    }
    
    
    public function consultarPorNumero() {
        return "SELECT id_apartamento, numero, id_propietario
            FROM apartamento
            WHERE numero = " . $this->numero;
    }
    
    public function insertar() {
        return "INSERT INTO apartamento (numero, id_propietario)
            VALUES ($this->numero, $this->idPropietario)";
    }
    
    public function actualizar() {
        return "UPDATE apartamento
            SET numero = $this->numero, id_propietario = $this->idPropietario
            WHERE id_apartamento = $this->idApartamento";
    }
    
    public function eliminar() {
        return "DELETE FROM apartamento WHERE id_apartamento = $this->idApartamento";
    }
    
    public function consultarTodos() {
        return "SELECT id_apartamento, numero, id_propietario FROM apartamento";
    }
    
}

?>