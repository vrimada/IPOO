<?php 
include 'Viaje.php'; 
$Viaje = null;
$opcion = 1;

/**
 * Menu del sistema
 */
while($opcion != 0){
    echo "\033[4m\033[1mViaje Feliz:\033[0m";
    echo "
    0-Salir del programa
    1-Cargar informacion de un viaje
    2-Cargar pasajero en el viaje
    3-Modificar información viaje cargado y sus pasajeros
    4-Visualizar datos del viaje\n ";
    $opcion = readline();
    
    switch($opcion){
        case 0 : echo "Finalizo el sistema.\n"; break;
        case 1 : $Viaje = crearViaje(); break;     
        case 2 :   if($Viaje != null)
                    agregarPasajero($Viaje);
                    else
                        echo "ERROR: no creo un viaje, elija opcion 1.\n";
            break;
        case 3 :  if($Viaje != null)
                    cambiarDatosViaje($Viaje);
                    else
                        echo "ERROR: no creo un viaje, elija opcion 1.\n";
            break;
        case 4 : if($Viaje != null)
                 echo $Viaje;
                    else
                        echo "ERROR: no creo un viaje, elija opcion 1.\n";
            break;
        default : echo "ERROR: elija la opcion correcta: 0-1-2-3-4.\n"; 
            break;
    }
}

/**
 * Crea un viaje con los parametros ingresados por el usuario
 * devolviendo el viaje
 * @return Viaje
 */
function crearViaje(){
  $pasajeros = [];
  $esCorrecto = false;
  $codigo = readline("Ingrese el codigo: ");  
  $destino = readline("Ingrese el destino: ");

  while(!$esCorrecto){
    $capacidad = readline("Ingrese la capacidad: ");  
    if(is_numeric($capacidad)){
        $esCorrecto = true;
    }else{
        echo "ERROR: debe ingresar un numero.\n"; 
    }
  }
  $Viaje = new Viaje($codigo, $destino, $capacidad, $pasajeros);
  echo "
¡Se creo correctamente un nuevo viaje! \n";
  return $Viaje;
}
/**
 * Se agrega un pasajero en el viaje
 * @param Viaje
 */
function agregarPasajero($nuevoViaje){
    if(count($nuevoViaje->getPasajeros()) < $nuevoViaje->getCantMaxima()){
        $nombrePasajero = readline("Ingrese Nombre del Pasajero: ");
        $apellidoPasajero = readline("Ingrese Apellido del Pasajero: ");
        $dniPasajero = readline("Ingrese DNI del Pasajero: ");
        $nuevoViaje->populatePasajeros($nombrePasajero, $apellidoPasajero, $dniPasajero);
    }else{
   echo "IMPOSIBLE REALIZAR LA ACCCION: Ya completo la capacidad maxima de pasajeros\n";
    }
}
/**
 * Se cambian datos del viaje y sus pasajeros
 * @param Viaje
 */
function cambiarDatosViaje(&$Viaje){
    $esCorrecto=false;
    $op=1;
   while($op != 0){
    echo "\033[4m\033[1mSubmenu cambiar datos del Viaje :\033[0m";
    echo "
    0 - Salir de Submenu
    1 - Cambiar Codigo
    2 - Cambiar Destino
    3 - Cambiar Capacidad maxima
    4 - Cambiar Pasajeros\n";
    $op = readline();
    switch($op){
        case 0: ;break;
        case 1: $cambiarCodigo = readline("Ingrese nuevo codigo de vuelo: ");
            $Viaje->setCodigo($cambiarCodigo);
        break;
        case 2:
            $destino  = readline("Ingrese nuevo destino:");
            $Viaje->setDestino($destino);
        break;
        case 3:
            $maximo = readline("Ingrese nueva capacidad maxima:");
            $Viaje->setcantMaxima($maximo);
            break;
        case 4:  cambiarPasajero($Viaje);
           break;
        default: echo "ERROR: elija la opcion correcta: 0-1-2-3-4.\n";
        }
   }
}
/**
 * Metodos para cambiar los datos del pasajero del viaje
 * @param Viaje
 */
function cambiarPasajero($Viaje){
    $esCorrecto=false; $encontro=false;
    $op=1; $posicion=-1; $i=0;
    $array_pasajeros = $Viaje->getPasajeros();
    $largo=count($array_pasajeros);
    
    if($largo>0){
        while(!$esCorrecto){
            $dni = readline("Ingrese el DNI para modificar el pasajero");
            if(is_numeric($dni)){
                $esCorrecto=true;
            }else{
                echo "ERROR: Debe ingresar un numero\n";
            }
        }
        
        //Encuentro la posicion del Pasajero
        while($i<$largo && !$encontro){
            if($array_pasajeros[$i]["dni"]==$dni){
               $encontro=true; 
               $posicion=$i;
            }
            $i++;
        }
        if($encontro){
            
                while($op != 0){
                    $esCorrecto=false;
                    echo  
                "Ingrese que desea modificar del pasajero
                0- Salir
                1- Nombre del pasajero
                2- Apellido del pasajero
                3- Dni del pasajero\n";
                $op = readline();
                switch($op){
                    case 1 : 
                        $nombrePasajero=readline("Ingrese nuevo Nombre");
                        $array_pasajeros[$posicion]["nombre"]=$nombrePasajero;
                        $Viaje->setPasajeros($array_pasajeros);
                        break;
                    case 2 : 
                        $apellidoPasajero=readline("Ingrese nuevo Apellido");
                        $array_pasajeros[$posicion]["apellido"]=$apellidoPasajero;
                        $Viaje->setPasajeros($array_pasajeros);
                        break;
                    case 3 : 
                        while(!$esCorrecto){
                            $i=0; $encontro=false;
                             $dniPasajero=readline("Ingrese nuevo DNI");
                             if(is_numeric($dniPasajero)){
                                 //Revisamos que no quiera ingresar un DNI que ya existe
                                while($i<$largo && !$encontro){
                                    if($array_pasajeros[$i]["dni"]==$dni){
                                       $encontro=true; 
                                    }
                                    $i++;
                                }
                                if($encontro){
                                    echo "ERROR, DNI duplicado.\n";

                                }else{
                                    $array_pasajeros[$posicion]["dni"]=$dniPasajero;
                                    $Viaje->setPasajeros($array_pasajeros);
                                }
                                 $esCorrecto=true;
                             }
                             else
                                echo "ERROR DNI tiene que ser un número\n";
                        }
                        break;
                        default: echo"ERROR Opcion incorrecta. Ingrese 0-1-2-3.\n"; break;
                   }
                }
            }
            else
                echo "ERROR No se encontro pasajero con ese DNI.\n";
        }
        else
            echo "ERROR:No hay ningun pasajero en el viaje.\n";
}

?>       