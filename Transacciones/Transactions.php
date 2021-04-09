<?php

    class Transactions{

        public $Id;
        public $Monto;
        public $Descripcion;
        public $Fecha;

        public function __construct($id,$monto,$descripcion,$fecha)
        {
            $this->Id = $id;
            $this->Monto = $monto;
            $this->Descripcion = $descripcion;
            $this->Fecha = $fecha;
        }
    }

?>