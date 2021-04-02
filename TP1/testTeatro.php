<?php
include 'Teatro.php';
$funciones = array();
test($funciones);


function test($funciones){
$teatro = null;
$opcion = 1;

while($opcion != 0){
    $opcion = readline("
    -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
    -* 0-Salir                              -*
    -* 1-Cargar informarcion del teatro     -*
    -* 2-Modificar informarcion del teatro  -*
    -* 3-Cambiar funciones                  -*
    -* 4-Mostrar teatro                     -*
    -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*");
    echo "\n";
    switch($opcion){
        case 0 : echo "Saliendo del test"; break;
        case 1 : $teatro = crearTeatro($funciones);break;
        case 2 : $teatro = cambiarValoresTeatro($teatro);break;
        case 3 : $teatro = cambiarValoresFuncion($teatro); break;
        case 4 : mostrarTeatro($teatro);break;
        default : echo "Error, elija la opcion correcta: 0-1-2-3."; break;
    }
}
}

function crearTeatro($funciones){
    $nombre = readline("Ingrese nombre del teatro:");
    $direccion = readline("Ingrese la direccion del teatro:");
    
    //se crea el teatro con los valores ingresador por el usuario
    $funciones = funcionesDefault($funciones);
    $teatro = new Teatro($nombre,$direccion, $funciones);
    
    //muestro la clase creada
    echo "Se creo correctamente el teatro.";
    echo $teatro;
    return $teatro;
}

function cambiarvaloresTeatro($teatro){
    if($teatro != null){
     
    $nombre = readline("Ingrese nuevo nombre del teatro:");
    $direccion = readline("Ingrese nueva direccion del teatro:");
    $teatro->setNombre($nombre);
    $teatro->setDireccion($direccion);

    echo "Se realizaron correctamente los cambios.";
    echo $teatro;
        
    } else echo "ERROR primero debe crear el teatro (OPCION 1).";
    return $teatro;
}

function cambiarValoresFuncion($teatro){
    if ($teatro != null){
        echo "Funciones para editar:";
        print_r($teatro->getFunciones());
        $posicion="";
        while(!is_numeric($posicion)){
        $posicion = readline("Selecione el numero de la que quiere editar.:");
        }
        $nombre = readline("Ingrese nuevo nombre:");
        $precio="";
        while(!is_numeric($precio)){
            $precio = readline ("Ingrese nuevo precio:");
        }
      
        $teatro->setFuncion($nombre,$precio,$posicion);
        echo "Cambio correctamente realizado.";
        echo $teatro->getFuncion($posicion);
    } else 
        echo "ERROR primero debe crear el teatro (OPCION 1).";
   return $teatro; 
}

function funcionesDefault($funciones){
    //carga cuatro funciones por defecto
    $funciones[0] = array("nombre"=> "Espera Trágica", "precio" => 300);
    $funciones[1] = array("nombre" => "El Cuiscuis", "precio"=>500);
    $funciones[2] = array("nombre" =>"La Fiaca" , "precio"=>250);
    $funciones[3] = array("nombre" => "El Pan de la Locura", "precio"=>350);
   //print_r ($funciones);
    return $funciones;

}
function mostrarTeatro($teatro){
    if($teatro!= null){
        echo $teatro;
        print_r($teatro->getFunciones());

    }else 
        echo "ERROR primero debe crear el teatro (OPCION 1).";
}

?>