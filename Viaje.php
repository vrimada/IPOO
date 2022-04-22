<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxima;
    private $pasajeros;
    private $responsablev;

    /**
     * Constructor del viaje
     * @param string codigo del viaje
     * @param string destino del viaje
     * @param int cantidad maxima de pasajeros
     * @param Array arreglo de pasajeros
     */
    public function __construct($c, $d, $cant, $responsablev){
        $this->codigo=$c;
        $this->destino=$d;
        $this->cantMaxima=$cant;
        $this->pasajeros=[];
        $this->responsablev=$responsablev;
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
    public function getResponsablev()
    {
        return $this->responsablev;
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
    public function setResponsablev($responsablev)
    {
        $this->responsablev = $responsablev;
    }

    // == FUNCTIONS ==
    /**
     * Carga un Pasajero en LA COLECCION  Pasajeros de la clase Viaje
     * @param Pasajero
     * @return bool 
     */
    public function populatePasajeros($pasajero) { 
       $encontro=$this->buscarAsiento($pasajero->getNumDoc()); 
        if  ($encontro != -1){ //si encontro alguien con ese pasaje no lo deja cargar
         return false;
        }else{
            $this->pasajeros[count($this->pasajeros)]=$pasajero;
           return true;
        }
    } 
    /**
     * funcion que devuelve el numero de asiento (posicion en arreglo) 
     * si ya existe un pasajero con el dni ingresado
     * sino devuelve -1
     */
    public function buscarAsiento($dni){
       $encontro=false;
        $i=0;
        $coleccion = $this->getPasajeros();
        while(!$encontro && $i<count($coleccion)){
            $p = $coleccion[$i];
            if($p->getNumDoc()==$dni)
               $encontro=true;
            else
                $i++;
        } 
        if($encontro)
            $asiento= $i;
        else 
            $asiento= -1;
        return $asiento;
    }
    
    /**
     * funcion que cambia un valor de un pasajero de la coleccion
     * en el parametro cambio se indica que atributo se va a cambiar
     * en el parametro nuevoValor se pasa el nuevo valor del atributo
     * el parametro dni tiene la "clave" para encontrar el pasajero a modificar
     */
    public function modificarPasajero($dni, $cambio, $nuevoValor){
        $asiento = $this->buscarAsiento($dni);
        $PasajeroOld =  $this->getPasajeros()[$asiento];
        switch($cambio){
            case "nombre":
               $PasajeroOld->setNombre($nuevoValor);
                break;
            case "apellido":
                $PasajeroOld->setApellido($nuevoValor);
                break;
            case "telefono":
                $PasajeroOld->setTelefono($nuevoValor);
                break;
        }
        $this->getPasajeros()[$asiento] = $PasajeroOld;
        $this->setPasajeros($this->getPasajeros());
    }
    /**
     * Arma un string con los datos del arreglo de pasajeros
     * @return string
     */
    public function datosPasajeros(){
        $aux = "";
        $coleccion_pasajeros = $this->pasajeros;
        if(count($coleccion_pasajeros)>0){
            foreach ($coleccion_pasajeros as $key => $p)
            {
                $aux = $aux." ".$p->__toString()."\n";
            }
            $aux = substr($aux,0,strlen($aux)-2);
            $aux  = $aux . "\n";
        }else{
            $aux ="No se han cargado pasajeros todavía.\n";
        }
        return $aux;
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
        "\n\033[1mResponsable: \033[0m".$this->getResponsablev().
        "\033[1mPasajeros:\033[0m\n".$this->datosPasajeros()."\n";
    }

}
