<?php
include 'EdificioTeatro.php';
include 'Actividad.php';
include 'Cine.php';
include 'Musical.php';
include 'ObraTeatro.php';

/**
 * @param array $coleccionFuncionesAuxiliar, $coleccionFunc
 * @return array
*/
function crearFuncion($coleccionFuncionesAuxiliar, $coleccionFunc){
    $coleccionObraTeatro = $coleccionFunc["obraTeatro"];
    $coleccionCine = $coleccionFunc["cine"];
    $coleccionMusical = $coleccionFunc["musical"];

    echo "Ingrese el nombre de la funcion: ";
    $nombreFuncion = trim(fgets(STDIN));
    echo "Ingrese el precio de la funcion " . $nombreFuncion . ": ";
    $precioFuncion = trim(fgets(STDIN));
    echo "Ingrese la duracion de la funcion en minutos: ";
    $duracionFuncion = trim(fgets(STDIN));
    echo "Ingrese la fecha de la funcion: " . "\n";
    echo "Dia: ";
    $dia = trim(fgets(STDIN));
    echo "Mes: ";
    $mes = trim(fgets(STDIN));
    $fecha = array("dia"=>$dia, "mes"=>$mes);
    do {
        echo "----------------------------------" . "\n";
        echo "Elija tipo de actividad: " . "\n";
        echo "1: Obra de Teatro" . "\n" ;
        echo "2: Cine" . "\n" ;
        echo "3: Musical" . "\n" ;
        echo "Opcion: ";
        $tipoActividad = trim(fgets(STDIN));
    } while ($tipoActividad>"3");
    echo "------------------------------------" . "\n";
    do {
        $existeHorarioFuncion = false;
        echo "Ingrese el horario de la funcion" . "\n";
        echo "Hora: ";
        $horaFuncion = trim(fgets(STDIN));
        echo "Minutos: ";
        $minutosFuncion = trim(fgets(STDIN));
        //convierto el horario de comienzo de la nueva funcion a minutos
        $horarioFuncionEnMinutos = ($horaFuncion*60)+$minutosFuncion;
        for($cont2=0; $cont2<(count($coleccionFuncionesAuxiliar)); $cont2++){
            //convierto el horario de inicio de la funcion ACTUAL a minutos
            $horaInicioFuncion = ($coleccionFuncionesAuxiliar[$cont2]["horaInicioFuncion"]["hora"]*60)+$coleccionFuncionesAuxiliar[$cont2]["horaInicioFuncion"]["minutos"];
            //establezco el horario de finalizacion de la funcion actual en minutos
            $horaFinalizacion = $horaInicioFuncion + $coleccionFuncionesAuxiliar[$cont2]["duracion"];

            $fechaActual = $coleccionFuncionesAuxiliar[$cont2]["fecha"];
            $diaActual = $fechaActual["dia"];
            $mesActual = $fechaActual["mes"];
            if(($diaActual==$dia) && ($mesActual==$mes)){
                //reviso si el horario de la nueva funcion se encuentra entre el horario de comienzo y finalizacion de la funcion actual
                if(($horarioFuncionEnMinutos>=$horaInicioFuncion) && ($horarioFuncionEnMinutos<=$horaFinalizacion)){
                    $existeHorarioFuncion = true;
                }
            }
        }
        if($existeHorarioFuncion){
            echo "Ya hay una funcion en este horario, ingrese otro horario para esta funcion" . "\n";
        }else{
            echo "El horario esta disponible. Horario seteado para la funcion " . $nombreFuncion . "\n";
        }
    }while($existeHorarioFuncion);
    //creo el array de la funcion nueva para guardarla en la coleccion de funciones auxiliar
    $funcionNueva = array("nombre"=>$nombreFuncion, "precio"=>$precioFuncion, "horaInicioFuncion"=>array("hora"=>$horaFuncion,"minutos"=>$minutosFuncion), "duracion"=>$duracionFuncion, "fecha"=>array("dia"=>$dia, "mes"=>$mes));
    array_push($coleccionFuncionesAuxiliar, $funcionNueva);
    
    //creo el objeto funcion para poder almacenarlo en la coleccion de funciones
    switch ($tipoActividad) {
        case '1':
            $horaInicioActividad = array("hora"=>$horaFuncion,"minutos"=>$minutosFuncion);
            $obraTeatro = new ObraTeatro($nombreFuncion, $horaInicioActividad, $fecha, $duracionFuncion, $precioFuncion);
            array_push($coleccionObraTeatro, $obraTeatro);
            $coleccionFunc["obraTeatro"] = $coleccionObraTeatro;
        break;
        case '2':
            echo "Su opcion fue CINE." . "\n";
            echo "Ingrese el Genero: ";
            $generoCine = trim(fgets(STDIN));
            echo "Ingrese el Pais de Origen: ";
            $paisDeOrigen = trim(fgets(STDIN));

            $horaInicioActividad = array("hora"=>$horaFuncion,"minutos"=>$minutosFuncion);

            $cine = new Cine($nombreFuncion, $horaInicioActividad, $fecha, $duracionFuncion, $precioFuncion, $generoCine, $paisDeOrigen);
            array_push($coleccionCine, $cine);
            $coleccionFunc["cine"] = $coleccionCine;
        break;
        case '3':
            echo "Su opcion fue MUSICAL." . "\n";
            echo "Ingrese el Director: ";
            $director = trim(fgets(STDIN));
            echo "Ingrese la Cantidad de Personas en Escena: ";
            $cantPersonasEnEscena = trim(fgets(STDIN));

            $horaInicioActividad = array("hora"=>$horaFuncion,"minutos"=>$minutosFuncion);

            $musical = new Musical($nombreFuncion, $horaInicioActividad, $fecha, $duracionFuncion, $precioFuncion, $director, $cantPersonasEnEscena);
            array_push($coleccionMusical, $musical);
            $coleccionFunc["musical"] = $coleccionMusical;
        break;
    }

    //array de colecciones para devolverlas al programa principal y podes implementarlas
    $conjuntoColecciones = array("auxiliar"=>$coleccionFuncionesAuxiliar, "objeto"=>$coleccionFunc);
    return($conjuntoColecciones);
}

/**
 * 
*/
function verFunciones($teatroFunciones){
    echo "--------------FUNCIONES--------------" . "\n";
    echo $teatroFunciones->consultarFunciones();
}

/**
 * PROGRAMA PRINCIPAL
*/
echo "Ingrese el nombre del teatro: ";
$nombreTeatro = trim(fgets(STDIN));
echo "Ingrese la direccion del teatro: ";
$direccionTeatro = trim(fgets(STDIN));

echo "Ingrese cuantas funciones hay en el teatro: ";
$cantFunciones = trim(fgets(STDIN));

$coleccionFuncionesAux[] = array("nombre"=>'base', "precio"=>'0', "horaInicioFuncion"=>array("hora"=>0,"minutos"=>0), "duracion"=>'0', "fecha"=>array("dia"=>0, "mes"=>0));//inicializo el array para poder buscar en la primera vuelta si hay alguna funcion en el horario indicado

$coleccionFunciones = array();
$coleccionFunciones["obraTeatro"] = [];

$coleccionFunciones["cine"] = [];

$coleccionFunciones["musical"] = [];

//este for lo hice para crear las funciones y almacenarlas en la coleccionFunciones para poder crear el objeto teatro
for($cont=0; $cont<$cantFunciones; $cont++){
    $coleFuncionNormalAux = crearFuncion($coleccionFuncionesAux, $coleccionFunciones);
    $coleccionFuncionesAux=$coleFuncionNormalAux["auxiliar"];
    $coleccionFunciones=$coleFuncionNormalAux["objeto"];
}
//creo objeto teatro
$teatro = new EdificioTeatro($nombreTeatro, $direccionTeatro, $coleccionFunciones);



do {
    echo "ELIJA UNA OPCION: " . "\n";
    echo "1: Cambiar nombre del teatro" . "\n";
    echo "2: Cambiar direccion del teatro" . "\n";
    echo "3: Ver informacion completa del teatro" . "\n";
    echo "4: Cambiar nombre y precio de alguna funcion" . "\n";
    echo "5: Ver solo funciones" . "\n";
    echo "6: Agregar una nueva funcion" . "\n";
    echo "7: Ver costos de utilizacion: " . "\n";
    echo "8: SALIR" . "\n";
    echo "Opcion: ";
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case '1':
            echo "Nombre actual: " . $teatro->getNombre() . "\n";
            echo "Ingrese el nuevo nombre: ";
            $nuevoNombreTeatro = trim(fgets(STDIN));
            $teatro->cambiarNombre($nuevoNombreTeatro);
            echo "---------INFORMACION TEATRO---------"  . "\n";
            echo $teatro;
            echo "------------------------------------" . "\n";
            break;
        case '2':
            echo "Direccion actual: " . $teatro->getDireccion() . "\n";
            echo "Ingrese la nueva direccion: ";
            $nuevaDireccionTeatro = trim(fgets(STDIN));
            $teatro->cambiarDireccion($nuevaDireccionTeatro);
            echo "---------INFORMACION TEATRO---------" . "\n";
            echo $teatro;
            echo "------------------------------------" . "\n";
            break;
        case '3':
            echo "---------INFORMACION TEATRO---------"  . "\n";
            echo $teatro;
            echo "------------------------------------" . "\n";
            break;
        case '4':
            do{
                $auxiliarFunciones = 0;
                $coleFuncionesTeatro=$teatro->getColeActividades();

                echo "ELIJA QUE FUNCION DESEA CAMBIAR SUS ATRIBUTOS" . "\n";
                //muestro el nombre de todas las funciones
                for ($contadorVueltas=1; $contadorVueltas <= (count($coleFuncionesTeatro)) ; $contadorVueltas++) { 
                    echo $contadorVueltas . ": Funcion " . $coleFuncionesTeatro[$auxiliarFunciones]->getNombre() . "\n";
                    $auxiliarFunciones++;
                }
                echo count($coleFuncionesTeatro)+1 . ": CANCELAR" . "\n";
                echo "Opcion: ";
                $opcionFuncion = trim(fgets(STDIN));
                //entro a cambiar los datos de una funcion en caso de que no sea la opcion de CANCELAR
                if($opcionFuncion<>count($coleFuncionesTeatro)+1){
                    echo "Nombre funcion " . $opcionFuncion . " actual: " . $coleFuncionesTeatro[($opcionFuncion-1)]->getNombre() . "\n";
                    echo "Precio funcion " . $opcionFuncion . " actual: " . $coleFuncionesTeatro[($opcionFuncion-1)]->getPrecio() . "\n";
                    echo "Ingrese el nuevo nombre de la funcion " . $opcionFuncion . ": ";
                    $nuevoNombreFuncion = trim(fgets(STDIN));
                    echo "Ingrese el nuevo precio de la funcion " . $opcionFuncion . ": ";
                    $nuevoPrecioFuncion = trim(fgets(STDIN));
                    $coleFuncionesTeatro[($opcionFuncion-1)]->setNombre($nuevoNombreFuncion);
                    $coleFuncionesTeatro[($opcionFuncion-1)]->setPrecio($nuevoPrecioFuncion);
                }
            }while($opcionFuncion<>count($coleFuncionesTeatro)+1);
            break;
        case '5':
            verFunciones($teatro);
            break;
        case '6':
            $coleFuncionNormalAux=crearFuncion($coleccionFuncionesAux, $coleccionFunciones);
            $coleccionFuncionesAux=$coleFuncionNormalAux["auxiliar"];
            $coleccionFunciones=$coleFuncionNormalAux["objeto"];
            $teatro->setColeActividades($coleccionFunciones);
            break;
        case '7':
            echo "Ingrese el mes del cual quiere conocer los costos: ";
            $mesDeseado = trim(fgets(STDIN));
            $costo = $teatro->darCostos($mesDeseado);
            echo "El costo total es de: $" . $costo . "\n";
            break;
    }
}while($opcion<>8);

