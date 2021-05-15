<?php

class ObraTeatro extends Actividad{

    public function __construct($nombre, $horIni, $fecha, $duracionActiv, $precio){
        parent::__construct($nombre, $horIni, $fecha, $duracionActiv, $precio);
    }

    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 0.45);
        return $costo;
    }

    public function __toString()
    {
        return  "-----------OBRA DE TEATRO-----------" . "\n" . 
                parent::__toString();
    }
}