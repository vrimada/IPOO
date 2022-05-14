<?php 
 class Aereos extends Viaje
{
    private $numeroVuelo;
    private $tipoAsiento;
    private $nombreAerolinea;
    private $cantidadEscalas;

    public function __construct($c, $d, $cant, $responsablev,$importe, $ida, $vuelta, $numeroVuelo, $tipoAsiento, $nombreAerolinea, $cantidadEscalas) {
        parent :: __construct($c, $d, $cant, $responsablev,$importe, $ida, $vuelta);
        $this->tipoAsiento=$tipoAsiento;
        $this->numeroVuelo=$numeroVuelo;
        $this->nombreAerolinea=$nombreAerolinea;
        $this->cantidadEscalas=$cantidadEscalas;
    }
    // --- GET Y SET ---    
    public function getNumeroVuelo(){
        return $this->numeroVuelo;
    }
    public function setNumeroVuelo($numeroVuelo){
        $this->numeroVuelo = $numeroVuelo;
    }
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }
    public function getNombreAerolinea(){
        return $this->nombreAerolinea;
    }
    public function setNombreAerolinea($nombreAerolinea){
        $this->nombreAerolinea = $nombreAerolinea;
    }
    public function getCantidadEscalas(){
        return $this->cantidadEscalas;
    }
    public function setCantidadEscalas($cantidadEscalas){
        $this->cantidadEscalas = $cantidadEscalas;
    }
    public function __toString(){
        $cadena = "";
        $cadena = parent :: __toString();
        $tipoAsiento = $this->nombreAsiento();
        $cadena = $cadena ."\033[1mNúmero vuelo:\033[0m". $this->getNumeroVuelo(). "  \033[1mNombre Aerolinea:\033[0m ".$this->getNombreAerolinea().
        "\033[1mTipo Asiento:\033[0m ".$tipoAsiento. " \033[1mCantidad Escalas:\033[0m" .$this->getCantidadEscalas()."\n";
        return $cadena;
    }

    public function nombreAsiento(){
        $asiento = $this->getTipoAsiento();
        $primeraclase = $asiento["primeraclase"];
        $tipoAsiento = "";
        if($primeraclase == 1)
            $tipoAsiento = "Primera clase";
        else
            $tipoAsiento = "Clase Economica";
        return $tipoAsiento;
    }
    public function venderPasaje($pasajero){
        $importe = parent :: venderPasaje($pasajero);
        if($importe != 0){//es que  hay lugar
            $tipos = $this->getTipoAsiento();

            if($tipos["primeraclase"]==1 ){
                if($this->getCantidadEscalas()== 0){
                    $importe = $importe + $importe * 40/100;
                }else{//tiene escalas
                    $importe = $importe + $importe * 60/100;
                }
            }
            $this->populatePasajeros($pasajero);
        }
        return $importe;
    }
}
?>