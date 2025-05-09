<?php

class Apartamento {
    private $id_apartamento;
    private $numero_int;
    private $bloque_int;
    private $id_propietario_int;
    private $created_at_DATETIME;
    private $updated_at_DATETIME;

    public function __construct($id_apartamento = 0,$numero_int = 0,$bloque_int = 0,$id_propietario_int = 0) {
        $this->id_apartamento = $id_apartamento;
        $this->numero_int = $numero_int;
        $this->bloque_int = $bloque_int;
        $this->id_propietario_int = $id_propietario_int;
    }

    public function getIdApartamento(){
        return $this->id_apartamento;
    }

    public function getNumeroInt(){
        return $this->numero_int;
    }

    public function getBloqueInt(){
        return $this->bloque_int;
    }

    public function getIdPropietarioInt(){
        return $this->id_propietario_int;
    }


}