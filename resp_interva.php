<?php
    include ('db.php');
    if(!empty($_POST['con'])){
        $con = ($_POST['con']*0.01);
        $dne = $_POST['dne'];
    }
    $querys = "SELECT SUM(muestra) FROM muestras";
    $queryp = "SELECT count(muestra) FROM muestras";
    $promedi = mysqli_query($conn, $queryp);
    $promedio = mysqli_query($conn, $querys);

    $query = "SELECT * FROM muestras";
    $S=0;
    
    $pro = mysqli_fetch_array($promedio);
    $proq = mysqli_fetch_array($promedi);

    $P = $pro['0']/$proq['0'];

    $select = mysqli_query($conn, $query);
    
    while($rows = mysqli_fetch_array($select)){ 
        $S = pow(($rows['MUESTRA']-$P),2)+$S;
    }
    $S = $S/($proq['0']-1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="img/esta.jpg" id="bg-img">
    <a href="index.php"><button id="btn-int">Inicio</button></a>
    <a href="esti_puntual.php"><button id="btn-var">Puntual</button></a>
    <div class="index" style="height: 120%;">
        <h1>Resultados dada la muestra:</h1>
        <p>Lo primero es hacer un conteo de cuantos datos fueron agregados a la muestra (n): </p>
        <b>Muestra (n): <?php echo $proq['0']; ?></b>
        <p>El nivel de confianza fue establecido por el usuario en porcentajes este es: </p>
        <b>Nivel de Confianza (NC): <?php echo $con*100;?>%</b>
        <p>El calculo de la frecuencia es dado por el area resultante a la resta de 1-(Alpha/2), para el culculo de la misma es requerido la resolucion de integrales, por lo que fueron desarrolladas tablas para facilitar el acceso a dichas frecuencias, por ende, esta es optenida directamente por el usuario, e integrada a mano: </p>
        <b>Frecuencia de distribucion(Zalpha/2): <?php echo ($dne) ?></b>
        <p>La media muestral es calculada por la suma de cada uno de los valores agregados a la muestra y luego estos son dividos por el conteo de los datos que fueron agregados a la muestra: </p>
        <b>Media Muestral:<?php echo round($P,2);?></b>
        <p>La desviación estándar poblacional es una medida que indica la variación entre los datos de una población. Se representa con la letra griega sigma. La desviación estándar poblacional se calcula como la raíz cuadrada de la varianza de la población.</p>        
        <b>Desviacion Estandar: <?php echo round(sqrt($S),2); ?></b>
        <p>Ya con estos datos podemos desarrollar dos puntos que nos daran un intervalo entre los datos de la muestra con los cuales podremos estimar entre cuanto y cuanto se encuentra la media poblacional</p>
        <b>Intervalo Menor que la media (< u): <?php echo round($P-($dne*(sqrt($S)/sqrt($proq['0']))),2); ?></b><br>
        <b>Intervalo Mayor que la media (> u): <?php echo round($P+($dne*(sqrt($S)/sqrt($proq['0']))),2); ?></b>
    </div>
</body>
</html>
