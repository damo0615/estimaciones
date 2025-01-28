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
    <a href="esti_interva.php"><button id="btn-var">Por intervalos</button></a>
    <div  class="index">
        <h1>Estimacion Puntual</h1>
        <h2>Ingrese los datos para su muestra:</h2>
        <form action="insert.php" method="POST">
            <input type="float" name="muestra" autofocus>
            <input type="submit" name="sent">
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
        <p>Una vez termine de ingresar los datos de su muestra, coloque el intervalo a buscar. Ej:Busca el porcentaje de niños menores a 10 años en un salon:</p><br>
        <form action="resp_puntual.php" method="POST">
                <label>Desde:</label><input type="float" name="desde" required><br>
                <label>Hasta: </label><input type="float" name="hasta" required><br>
                <input type="submit" name="var" value="Calcular Parametros de Estimacion" id="btn-par">
        </form>
        <br><br>
        <form action="clean.php" metho="POST">
                <input type="submit" name="clean" value="Limpiar Muestra" id="clean" >
        </form>
    </div>
</body>
</html>
