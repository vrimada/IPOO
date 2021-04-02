<?php   
class Teatro{
    //Un teatro se caracteriza por su nombre y su dirección y en él se realizan 4 funciones al día. 
    //Cada función tiene un nombre y un precio.
    private $nombreTeatro;
    private $direccionTeatro;
    private $funciones;

    //Clase constructora con valores
    public function __construct($nombre, $direccion, $func){
        $this->nombreTeatro = $nombre;
        $this->direccionTeatro = $direccion;
        $this->funciones = $func;
    }

    //cambiar los valores de los atributos de teatro
    public function setNombre($nombre){
        $this->nombreTeatro = $nombre;
    }
    public function setDireccion($direccion){
        $this->direccionTeatro = $direccion;
    }

    public function setFuncion($nombre, $precio, $posicion)
    {

    if($this->funciones[$posicion]["nombre"] != null && $this->funciones[$posicion]["precio"] != null){

      $this->funciones[$posicion]["nombre"] = $nombre;
      $this->funciones[$posicion]["precio"] = $precio;
    } else echo "No se cargaron funciones en esa posicion, revisar arreglo de funciones\n";
    }

    //Obtener los valores de la clase teatro
    public function getNombre(){
        return $this->nombreTeatro;
    }
    public function getDireccion(){
        return $this->direccionTeatro;
    }
    public function getFunciones(){
        return $this->funciones;
    }
    public function getFuncion($posicion)
    {

    if($this->funciones[$posicion]["nombre"] != null && $this->funciones[$posicion]["precio"] != null){

      return "(Nombre funcion:".$this->funciones[$posicion]["nombre"].", Precio:".$this->funciones[$posicion]["precio"].")";
    
    } else return "No se cargaron funciones en esa posicion, revisar arreglo de funciones.";

    }


    //metodos y funciones miscelaneos
    public function __toString(){
		return "(Nombre Teatro: ".$this->getNombre().", Direccion:".$this->getDireccion().")";
	}
	
	/*public function __destruct(){
		echo $this . " instancia destruida, no hay referencias a este objeto \n";
	}*/

}

?>