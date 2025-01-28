<?php
    include 'db.php';

    $query = "SELECT * FROM muestras";    
    $select = mysqli_query($conn, $query);           
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <img src="img/esta.jpg" id="bg-img">
    <a href="index.php"><button id="btn-int">Inicio</button></a>
    <a href="esti_puntual.php"><button id="btn-var">Puntual</button></a>
    <div class="index">
    <h1>Estimacion Por Intervalo</h1>
        <h2>Ingrese los datos para su muestra:</h2>
        <form action="insert.php" method="POST">
            <input type="float" name="muestra" autofocus>
            <input type="submit" name="send">
        </form>
        <table>
        <tr>
            <?php  
                $fila=0;
                while($rows = mysqli_fetch_array($select)){ 
                    $fila++;
                    echo "<td>".$rows['MUESTRA']."</td>";
                    if($fila == 6){
                        echo "</tr>";
                        $fila = 0;
                    }
                }
            ?>
            
        </table>
        <b>Una vez termine de ingresar los datos de su muestra, coloque el intervalo a buscar. Ej:Busca el porcentaje de niños menores a 10 años en un salon:</b><br>
        <form action="resp_interva.php" method="POST">
                <label>Nivel de confianza: </label><br><input type="float" name="con" required><br>
                <label>Distribucion Normal Estandar Inversa: </label><br><input type="float" name="dne" required><br>
                <input type="submit" name="var" value="Calcular Intervalos de Confianza" id="btn-par">
        </form>
        <br><br>
        <form action="clean.php" metho="POST">
                <input type="submit" name="delete" value="Limpiar Muestra" id="clean">
        </form>
    </div>    
</body>
</html>