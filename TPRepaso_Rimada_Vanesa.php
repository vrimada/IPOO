<?php  
 
 main();

 function main(){

    $arrayVinos = cargaVinos(); //realizo la carga del arreglo con las variedades, con sus respectivas cantidades, años de produccion y precios
    $arrayPromedio = promedioVariedades($arrayVinos); // devuelve un arreglo de variedades con sus cantidades y precio promedio
    print_r($arrayPromedio);
 }
 
 function cargaVinos(){

    $vinos = array();
    $vinos["Malbec"] = array(
       ["cantBotellas" =>4,"anioproduccion" =>1980,"precioUnitario"=>2500],
       ["cantBotellas" =>6,"anioproduccion" =>1990,"precioUnitario"=>2300],
       ["cantBotellas" =>10,"anioproduccion" =>1975,"precioUnitario"=>5000]);
    $vinos["Cabernet"] =  array(
       ["cantBotellas" =>350,"anioproduccion" =>2002,"precioUnitario"=>950],
       ["cantBotellas" =>275,"anioproduccion" =>2010,"precioUnitario"=>1200],
       ["cantBotellas" =>150,"anioproduccion" =>1980,"precioUnitario"=>980]);
    $vinos["Merlot"] =  array( 
       ["cantBotellas" =>150,"anioproduccion" =>2014,"precioUnitario"=>1000],
       ["cantBotellas" =>150,"anioproduccion" =>2015,"precioUnitario"=>950],
       ["cantBotellas" =>200,"anioproduccion" =>2020,"precioUnitario"=>550]);
       return $vinos;
     }  

     function promedioVariedades($vinos){
        $j = 0;
        $claves = array_keys($vinos);
        foreach ($vinos as $vino){
             //empieza el foreach con Malbec, luego con Cabernet, y termina con Merlot.
            
            $cantidad = count($vino);
            $cantXVariedad = 0; $total = 0; $precioPromedio = 0; 

            for($i=0;$i<$cantidad;$i++){
               $cantXVariedad = $cantXVariedad + $vino[$i]["cantBotellas"];
               $total = $total +  $vino[$i]["precioUnitario"];
            }
            $precioPromedio = round($total/$cantXVariedad);
            $nuevoArreglo[$claves[$j]] = array("cantBotellas"=>$cantXVariedad, "precioPromedio"=>$precioPromedio);
            $j++;
            
            
        }
        return $nuevoArreglo;

    }
     
    ?>

 