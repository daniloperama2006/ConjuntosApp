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
        return "select a.id_apartamento , a.numero, a.bloque, a.id_propietario, u.nombre, u.apellido
                from apartamento a join usuario u on (a.id_propietario = u.id_usuario)
                where a.id_propietario = 3";
    }

}

?>