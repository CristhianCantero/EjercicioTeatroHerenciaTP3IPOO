<?php
class EdificioTeatro{
    private $nombre;
    private $direccion;
    private $coleActividades;
    
    public function __construct($nombre, $direccion, $coleActividades)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->coleActividades = $coleActividades;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColeActividades(){
        return $this->coleActividades;
    }

    public function setNombre($n){
        $this->nombre = $n;
    }
    public function setDireccion($d){
        $this->direccion = $d;
    }
    public function setColeActividades($coleFunc){
        $this->coleActividades = $coleFunc;
    }

    public function cambiarNombre($nomb){
        $this->setNombre($nomb);
    }
    public function cambiarDireccion($dire){
        $this->setDireccion($dire);
    }

    public function darCostos($mes){
        $coleccionActivides = $this->getColeActividades();
        $coleccionObrasDeTeatro = $coleccionActivides["obraTeatro"];
        $coleccionCine = $coleccionActivides["cine"];
        $coleccionMusicales = $coleccionActivides["musical"];

        $costoObrasDeTeatro = 0;
        $costoCine = 0;
        $costoMusicales = 0;
        // COLECCION OBRAS DE TEATRO
        foreach ($coleccionObrasDeTeatro as $obraTeatro) {
            $fecha = $obraTeatro->getFecha();
            $mesActual = $fecha["mes"];
            if($mes == $mesActual){
                $costoActual = $obraTeatro->darCostos();
                $costoObrasDeTeatro = $costoObrasDeTeatro + $costoActual;
            }
        }
        // COLECCION PELICULAS DE CINE
        foreach ($coleccionCine as $cine) {
            $fecha = $cine->getFecha();
            $mesActual = $fecha["mes"];
            if($mes == $mesActual){
                $costoActual = $cine->darCostos();
                $costoCine = $costoCine + $costoActual;
            }
        }
        // COLECCION MUSICALES
        foreach ($coleccionMusicales as $musical) {
            $fecha = $musical->getFecha();
            $mesActual = $fecha["mes"];
            if($mes == $mesActual){
                $costoActual = $musical->darCostos();
                $costoMusicales = $costoMusicales + $costoActual;
            }
        }

        $costoTotal = $costoObrasDeTeatro + $costoCine + $costoMusicales;

        return $costoTotal;
    }

    public function consultarFunciones(){
        $coleccionAct = $this->getColeActividades();
        $stringColecciones = "";
        foreach ($coleccionAct as $actividad) {
            foreach ($actividad as $arrayActividad) {
                $stringColecciones = $stringColecciones . $arrayActividad . "\n";
            }
        }
        return $stringColecciones;
    }
    
    public function __toString()
    {
        $funciones = $this->consultarFunciones();
        return ("Nombre del teatro: " . $this->getNombre() . "\n" .
                "Direccion del teatro: " . $this->getDireccion() . "\n" .
                "--------------Actividades--------------" . "\n" . 
                $funciones
            );

    }
}
