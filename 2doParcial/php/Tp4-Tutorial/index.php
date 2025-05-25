<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Php</title>

</head>
<body>

    <header>
        <h1>PHP</h1>
    </header>

    <main class="contenedorPrincipal">
        <?php
        $variable = 0;
        $vector = array();

        for($i=0; $i<6; $i++){
            ++$variable;
            if($variable === 5){
                echo "<p>El valor de mi variable es: {$variable} </p>";
            }else{
                array_push($vector, $variable);
            }
        }
        $pasoAString = implode(', ',$vector);
        echo "<p>El valor de mi array es: {$pasoAString} </p>";
        
        

        //Supresion de errores no fatales
        @$supresion = 0;
        if(!$supresion){
            echo "Errorrrrrrrrrrrrrrr";
        }
        
        
        //Supresion de errores fatales
        try {
        $supresion = 5 / 0;
        echo $supresion;
        } catch (DivisionByZeroError $e) {
            echo "Errorrrrrrrrrrrrrrr: " . $e->getMessage();
        }


        //tablas de multiplicar
        $numero = 0;
        echo "<p></p>";

        for($i=0; $i<10; $i++){
            echo "<p>{$i}</p>";
            for($k=0; $k<10; $k++){
                echo " {$k}";
            }
            echo "<p></p>";
            for($j=0; $j<10; $j++){
                $resultado = $j*$i;
                echo " {$resultado}";
            }
            echo "<p></p>";
        }

        //Arreglo asociativo
        $arregloAsociativo = array(
            "Primero" => "1",
            "Segundo" => "2",
            "Tercero" => "3"
        );

        foreach($arregloAsociativo as $indice => $valor){
            echo "$indice : $valor";
        };
        echo "<p></p>";
        echo count($arregloAsociativo);

        ?>
    </main>
    
    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>

    <script src="script.js" ></script>
</body>
</html>
