<?php
include 'Cine.php';

/**
 * Programa principal
*/

$nombre = "Los kirchneristas";
$horaI = array("hora"=>15, "minutos"=>30); //array para poder almacenar la hora y minutos por separado
$duracion = 115; //la duracion se establece en minutos
$precio = 2500;
$genero = "Terror";
$paisOrigen = "Argentina";

$cine1 = new Cine($nombre, $horaI, $duracion, $precio, $genero, $paisOrigen);

echo $cine1;

