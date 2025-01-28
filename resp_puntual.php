<?php
    include ('db.php');
    if(!empty($_POST['var'])){
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
    }
    $queryc = "SELECT count(muestra) FROM muestras WHERE muestra >= '$desde' AND muestra <= '$hasta'";
    $querys = "SELECT SUM(muestra) FROM muestras";
    $queryp = "SELECT count(muestra) FROM muestras";
    $promedi = mysqli_query($conn, $queryp);
    $promedio = mysqli_query($conn, $querys);
    $proporcion = mysqli_query($conn, $queryc);

    $query = "SELECT * FROM muestras";
    $S=0;
    
    $pro = mysqli_fetch_array($promedio);
    $proq = mysqli_fetch_array($promedi);
    $prop = mysqli_fetch_array($proporcion);

    $P = $pro['0']/$proq['0'];

    $select = mysqli_query($conn, $query);
    while($rows = mysqli_fetch_array($select)){ 
        $S = pow(($rows['MUESTRA']-$P),2)+$S;
    }
    $S = $S/($proq['0']-1);
?>
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
    <div class="index" style="height: 90%;">
        <h1>Resultados dada la muestra:</h1>
        <p>Lo primero es hacer un conteo de cuantos datos fueron agregados a la muestra (n): </p>
        <b>Muestra (n): <?php echo $proq['0']; ?></b>
        <p>La media muestral es calculada por la suma de cada uno de los valores agregados a la muestra y luego estos son dividos por el conteo de los datos que fueron agregados a la muestra: </p>
        <b>Media Muestral:<?php echo round($P,2);?></b>
        <p>La varianza muestral es una medida estadística que indica la dispersión de un conjunto de datos en relación con su media. Se calcula a partir de una muestra de datos. Se calcula obteniendo la sumatoria cada valor de la muestra se resta a la media muestral y es elevado al cuadrado</p>
        <b>Varianza Muestral: <?php echo round($S,2);?></b>
        <p>La desviación estándar poblacional es una medida que indica la variación entre los datos de una población. Se representa con la letra griega sigma. La desviación estándar poblacional se calcula como la raíz cuadrada de la varianza de la población.</p>        
        <b>Desviacion Estandar: <?php echo round(sqrt($S),2); ?></b>
        <p>La proporción muestral es la proporción de individuos de una muestra que tienen una característica específica. Se utiliza para estimar la proporción de una característica en una población.</p>
        <b>Proporcion Muestral: <?php echo round((($prop['0']/$proq['0'])/0.01),2)?>%</b>
    </div>
</body>
<?php include "footer.html";?>
</html>