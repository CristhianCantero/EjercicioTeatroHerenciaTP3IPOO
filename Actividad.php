<?php

class Actividad{
    private $nombre;
    private $horaInicio = array();
    private $fecha = array();
    private $duracionActividad;
    private $precio;

    public function __construct($nombre, $horaInicio, $fecha, $duracionActividad, $precio)
    {
        $this->nombre = $nombre;
        $this->horaInicio = array(
            "hora"=> $horaInicio['hora'],
            "minutos"=> $horaInicio['minutos']
        );
        $this->fecha = array(
            "dia"=> $fecha['dia'],
            "mes"=> $fecha['mes']
        );
        $this->duracionActividad = $duracionActividad;
        $this->precio = $precio;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getHoraInicio(){
        return $this->horaInicio;
    }
    public function getDuracionActividad(){
        return $this->duracionActividad;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setNombre($nom){
        $this->nombre=$nom;
    }
    public function setHoraInicio($horaIni){
        $this->horaInicio=$horaIni;
    }
    public function setDuracionActividad($duraObra){
        $this->duracionActividad=$duraObra;
    }
    public function setPrecio($pre){
        $this->precio=$pre;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function darCostos(){
        $precio = $this->getPrecio();

        return $precio;
    }

    public function cambiarFuncion($funcion){
        $this->setNombre($funcion["nombre"]);
        $this->setPrecio($funcion["precio"]);
    }
    public function mostrarHorarioFuncion(){
        $hora = $this->getHoraInicio();
        echo $hora['hora'] . ":" . $hora['minutos'];
    }

    public function __toString()
    {  
        $horario = $this->getHoraInicio();
        $fecha = $this->getFecha();
        return  "Nombre: " . $this->getNombre() . "\n" .
                "Precio: " . $this->getPrecio() . "\n" .
                "Fecha: " . $fecha["dia"] . "/" . $fecha["mes"] . "\n" .
                "Hora de inicio: " . $horario['hora'] . ":" . $horario['minutos'] . "\n" .
                "Duracion: " . $this->getDuracionActividad() . " minutos" . "\n"
                ;
    }

    

    
}




