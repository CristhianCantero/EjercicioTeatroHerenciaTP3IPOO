<?php

class Cine extends Actividad{
    private $genero;
    private $paisOrigen;

    public function __construct($nombre, $horIni, $fecha, $duracionActiv, $precio, $genero, $paisOrigen){
        parent::__construct($nombre, $horIni, $fecha, $duracionActiv, $precio);
        $this->genero = $genero;
        $this->paisOrigen = $paisOrigen;
    }
     
    public function getGenero()
    {
        return $this->genero;
    }
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }
    public function setPaisOrigen($paisOrigen)
    {
        $this->paisOrigen = $paisOrigen;
    }

    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 0.65);
        return $costo;
    }

    public function __toString()
    {
        return  "-----------CINE-----------" . "\n" . 
                parent::__toString() . 
                "Genero: " . $this->getGenero() . "\n" . 
                "Pais de Origen: " . $this->getPaisOrigen() . "\n"
                ;
    }
}