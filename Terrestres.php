<?php 
class Terrestres extends Viaje
{
    private $tipoAsiento;

    public function __construct($c, $d, $cant, $responsablev,$importe, $ida, $vuelta,$t){
        parent :: __construct( $c, $d, $cant, $responsablev,$importe, $ida, $vuelta);
        $this->tipoAsiento=$t;
    }
    // -- GET Y SET --
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }
    
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }

    public function __toString(){
        $cadena = parent :: __toString();
        $tipoA = $this->nombreAsiento();
        $cadena .= "\033[1mTipo Asiento:\033[0m ". $tipoA."\n";
        return $cadena;
    }
    
    public function nombreAsiento(){
        $tipo = $this->getTipoAsiento();
        $cama = $tipo["cama"];
        $tipoA = "";
        if($cama == 1)
            $tipoA= "Cama";
        else
            $tipoA="Semi Cama";

        return $tipoA;
    }
    // --- FUNCTIONS ---
    public function venderPasaje($pasajero){
        $importe = parent :: venderPasaje($pasajero);
        if($importe != 0){//es que  hay lugar
            $tipos = $this->getTipoAsiento();
            if($tipos["cama"]==1){
                $importe = $importe + ($importe * 25/100);
            }
            $this->populatePasajeros($pasajero);
        }
        return $importe;
    }
} 

?>

