<?php

class Musical extends Actividad{
    private $director;
    private $cantidadPersonasEscena;

    public function __construct($nombre, $horIni, $fecha, $duracionActiv, $precio, $director, $cantidadPersonasEscena){
        parent::__construct($nombre, $horIni, $fecha, $duracionActiv, $precio);
        $this->director = $director;
        $this->cantidadPersonasEscena = $cantidadPersonasEscena;
    }
     
    public function getDirector()
    {
        return $this->director;
    }
    public function setDirector($director)
    {
        $this->director = $director;
    }
    public function getCantidadPersonasEscena()
    {
        return $this->cantidadPersonasEscena;
    }
    public function setCantidadPersonasEscena($cantidadPersonasEscena)
    {
        $this->cantidadPersonasEscena = $cantidadPersonasEscena;
    }

    public function darCostos()
    {
        $costo = parent::darCostos();
        $costo = $costo + ($costo * 0.12);
        return $costo;
    }

    public function __toString()
    {
        return  "-----------MUSICAL-----------" . "\n" . 
                parent::__toString() . 
                "Director del Musical: " . $this->getDirector() . "\n" . 
                "Cantidad de personas en Escena: " . $this->getCantidadPersonasEscena() . "\n"
                ;
    }
}