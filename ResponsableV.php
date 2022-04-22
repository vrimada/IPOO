<?php
 class ResponsableV{
     private $numEmpleado;
     private $numLicencia;
     private $nombre;
     private $apellido;

     public function __construct($e, $l, $n, $a)
     {
          $this->numEmpleado=$e;
          $this->numLicencia=$l;
          $this->nombre=$n;
          $this->apellido=$a;
     }
     public function getNumEmpleado()
     {
          return $this->numEmpleado;
     }
     public function setNumEmpleado($numEmpleado)
     {
          $this->numEmpleado = $numEmpleado;
     }
     public function getNumLicencia()
     {
          return $this->numLicencia;
     }
     public function setNumLicencia($numLicencia)
     {
          $this->numLicencia = $numLicencia;
     }
     public function getNombre()
     {
          return $this->nombre;
     }
     public function setNombre($nombre)
     {
          $this->nombre = $nombre;
     }

     public function getApellido()
     {
          return $this->apellido;
     }

     public function setApellido($apellido)
     {
          $this->apellido = $apellido;
     }
     public function __toString()
     {
          return $this->getApellido().", ".$this->getNombre()." núm empleado:".$this->getNumEmpleado()." - núm licencia:".$this->getNumLicencia()."\n";
     }
 }
?>