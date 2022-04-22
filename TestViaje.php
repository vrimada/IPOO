<?php 
include 'Viaje.php'; 
include 'Pasajero.php';
include 'ResponsableV.php';
$Viaje = null;
$opcion = 1;

/**
 * Menu del sistema
 */

while($opcion != 0){
    menu();
    $opcion = readline();
    $mensajeError = "ERROR: no creo un viaje, elija opcion 1";
    switch($opcion){
        case 0 : echo "Finalizo el sistema.\n"; break;
        case 1 : 
            $respuesta = readLine("Ingrese (1) para cargar nuevo viaje, sino (2) viaje Precargado");
            if($respuesta== 1){
                $Viaje = crearViaje();
            }
            else{
                if($respuesta== 2)
                    $Viaje = cargarValoresDefault();
            }
             break;     
        case 2 :   if($Viaje != null)
                    agregarPasajero($Viaje);
                    else
                        echo $mensajeError."\n";
            break;
        case 3 :  if($Viaje != null)
                    cambiarDatosViaje($Viaje);
                    else
                    echo $mensajeError."\n";
            break;
        case 4 : if($Viaje != null)
                cambiarPasajero($Viaje) ;
                else
                echo $mensajeError."\n";
        break;
        case 5 : if($Viaje != null)
                    cambiarResponsable($Viaje); 
                    else
                    echo $mensajeError."\n";
            break;
    case 6 : if($Viaje != null)
                echo $Viaje; 
                else
                echo $mensajeError."\n";
       break;
        default : echo "ERROR: elija la opcion correcta: 0-1-2-3-4-5.\n"; 
            break;
    }
}

/**
 * Imprime menu del sistema VIAJE FELIZ
 */
function menu(){
echo "\033[4m\033[1mViaje Feliz:\033[0m";
echo "
0-Salir  
1-Cargar nuevo viaje
2-Cargar pasajero 
3-Modificar Viaje
4-Modificar Pasajero
5-Modificar Responsable viaje
6-Visualizar datos\n ";
}
/**
 * Menu para cambiar datos del viaje
 */
function menuDatosViaje(){
echo "Submenu cambiar datos viaje";
echo "
0 - Salir de Submenu
1 - Codigo
2 - Destino
3 - Capacidad maxima\n";
}
/**
 * Function que imprime menu para cambiar datos del pasajero
 */
function menuPasajero(){
echo "Submenu cambiar datos pasajero";
echo  
"
0- Salir
1- Nombre 
2- Apellido
3- Telefono\n";
}
/**
 * Crea un viaje con los parametros ingresados por el usuario
 * devolviendo el viaje
 * @return Viaje
 */
function crearViaje(){
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
  echo "Ingrese los datos del responsable: \n";
    $nombre = readline("Ingrese Nombre: \n");
    $apellido = readline("Ingrese Apellido: \n");
    $numEmpleado = readline("Ingrese núm de empleado: ");
    $numLicencia = readline("Ingrese Número de licencia: \n");
    $r = new ResponsableV($numEmpleado, $numLicencia, $nombre, $apellido);
    $Viaje = new Viaje($codigo, $destino, $capacidad, $r);
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
        //Pido al usuario los datos para cargar un pasajero
        $nombre = readline("Ingrese Nombre del Pasajero: ");
        $apellido = readline("Ingrese Apellido del Pasajero: ");
        $dni = readline("Ingrese DNI del Pasajero: ");
        
        //Valido que el telefono
        $esCorrecto = false;
        while(!$esCorrecto){
            $telefono = readline("Ingrese numero de telefono:");  
            if(is_numeric($telefono)){
                $esCorrecto = true;
            }else{
                echo "ERROR: debe ingresar solo numeros sin signos.\n"; 
            }
          }
       
        $p = new Pasajero($nombre,$apellido,$dni,$telefono);
        if($nuevoViaje->populatePasajeros($p)){
            echo "Se agrego el pasajero con exito\n";
        }else{
            echo "Error: DNI duplicado\n";
        }
    }else{
   echo "IMPOSIBLE REALIZAR LA ACCCION: Ya completo la capacidad maxima de pasajeros\n";
    }
}

/**
 * Se cambian datos del viaje y sus pasajeros
 * @param Viaje
 */
function cambiarDatosViaje($Viaje){
    $esCorrecto=false;
    $op=1;
   while($op != 0){
    menuDatosViaje();
    $op = readline();
    switch($op){
        case 0: ;break;
        case 1: $cambiarCodigo = readline("Ingrese nuevo codigo: ");
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
            
        default: echo "ERROR: elija la opcion correcta: 0-1-2-3-4.\n";
        }
   }
}
/**
 * Funcion que cambia el responsable 
 * @param Viaje
 */
function  cambiarResponsable($Viaje){
    echo "Ingrese los nuevos datos del responsable: \n";
    $nombre = readline("Ingrese Nombre: \n");
    $apellido = readline("Ingrese Apellido: \n");
    $numEmpleado = readline("Ingrese núm de empleado: ");
    $numLicencia = readline("Ingrese Número de licencia: \n");
    $r = new ResponsableV($numEmpleado, $numLicencia, $nombre, $apellido);
    $Viaje->setResponsablev($r);
}
/**
 * Metodos para cambiar los datos del pasajero del viaje
 * @param Viaje
 */
function cambiarPasajero($Viaje){
    $esCorrecto=false; 
    $encontro=false;
    $op=1; $posicion=-1; $i=0;
    $coleccion_pasajeros = $Viaje->getPasajeros();
    $largoColeccionPasajeros=count($coleccion_pasajeros);
    
    if($largoColeccionPasajeros>0){
        while(!$esCorrecto){
            $dni = readline("Ingrese el DNI para modificar el pasajero");
            if(is_numeric($dni)){
                $esCorrecto=true;
            }else{
                echo "ERROR: Debe ingresar un numero\n";
            }
        }
        // Creo un Pasajero solo con dni para verificar si existe para modificarlo
        $encontro=$Viaje->buscarAsiento($dni);

        if($encontro != -1){
            while($op != 0){
                $esCorrecto=false;
                menuPasajero();
                $op = readline();
                switch($op){
                    case 1 : 
                        $nombrePasajero=readline("Ingrese nuevo Nombre");
                        $Viaje->modificarPasajero($dni,"nombre",$nombrePasajero);
                        break;
                    case 2 : 
                        $apellidoPasajero=readline("Ingrese nuevo Apellido");
                        $Viaje->modificarPasajero($dni, "apellido",$apellidoPasajero);
                        break;
                    case  3:
                        while(!$esCorrecto){
                            $telefono=readline("Ingrese nuevo telfono");
                            if(is_numeric($telefono) ){
                                $Viaje->modificarPasajero($dni, "telefono",$telefono);
                                $esCorrecto=true;
                            }else{
                                echo "ERROR ingrese un numero valido\n";
                            }
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
/**
 * funcion que carga datos al test
 */
function cargarValoresDefault(){
    $p1 = new Pasajero('Alejandro', 'Rimada', 35254587, 156144758);
    $p2 =  new Pasajero('Marta', 'Maidana', 20178189, 154112233);
    $r = new ResponsableV(01, 1010, 'Gustavo', 'Borquez');
    $Viaje = new Viaje('Viaje01', 'CABA', 50 , $r);
    $Viaje->populatePasajeros($p1);
    $Viaje->populatePasajeros($p2);
    echo "Se cargaron datos por defecto con exito.\n";
    return $Viaje;
}
?>       