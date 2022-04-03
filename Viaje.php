<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxima;
    private $pasajeros=[];

    /**
     * Constructor del viaje
     * @param string codigo del viaje
     * @param string destino del viaje
     * @param int cantidad maxima de pasajeros
     * @param Array arreglo de pasajeros
     */
    public function __construct($c, $d, $cant, $p){
        $this->codigo=$c;
        $this->destino=$d;
        $this->cantMaxima=$cant;
        $this->pasajeros=$p;
    }
    //=== GET ===
    public function getCodigo(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxima(){
        return $this->cantMaxima;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    // == SET ==
    public function setCodigo($c){
        $this->codigo=$c;
    }
    public function setDestino($d){
        $this->destino=$d;
    }
    public function setcantMaxima($m){
        $this->cantMaxima=$m;
    }
    public function setPasajeros($p){
        $this->pasajeros=$p;
    }
    // == FUNCTIONS ==
    /**
     * Carga un Pasajero en el arreglo Pasajeros de la clase Viaje
     * @param string
     * @param string
     * @param int 
     */
    public function populatePasajeros($nombre, $apellido, $dni) { 
        $repetido=false;
        foreach($this->pasajeros as $key => $p){
            if($p["dni"]==$dni){
            $repetido=true;
            }
        } 
        if($repetido){
         echo "ERROR DNI REPETIDO\n";
        }else{
            $arrayP = array( 
                'nombre'=> $nombre,
                'apellido'=> $apellido,
                'dni'=> $dni
           );
           $this->pasajeros[count($this->pasajeros)]=$arrayP;
           echo "¡CARGA DE PASAJERO CON EXITO!\n";
        }
    } 
    /**
     * Definicion de metodo string
     * @return string
     */
    public function __toString(){
        return 
        "\033[4m\033[1mReporte: Viaje Feliz\033[0m
         \n\033[1mCodigo del viaje: \033[0m".$this->getCodigo().
        "\n\033[1mDestino: \033[0m".$this->getDestino().
        "\n\033[1mCapacidad Máxima: \033[0m".$this->getCantMaxima().
        "\n\033[1mPasajeros:\033[0m\n".$this->datosPasajeros()."\n";
    }

    /**
     * Arma un string con los datos del arreglo de pasajeros
     * @return string
     */
    public function datosPasajeros(){
        $aux = "";
        $arregloSalida = $this->pasajeros;
        if(count($arregloSalida)>0){
            foreach ($arregloSalida as $key => $subArr)
            {
                $aux = $aux."\033[1mNombre: \033[0m".$subArr["nombre"].
                " \033[1mApellido: \033[0m".$subArr["apellido"].
                " \033[1mDNI: \033[0m".$subArr["dni"].",\n";
            }
            $aux = substr($aux,0,strlen($aux)-2);
            $aux  = $aux . "\n";
        }else{
            $aux ="No se han cargado pasajeros todavía.\n";
        }
        return $aux;
       }
    }
?>