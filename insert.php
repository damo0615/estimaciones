<?php
    include 'db.php';
    $void = false;

    if(!empty($_POST['sent'])){
        $n = $_POST['muestra'];
        $query = "INSERT INTO muestras (MUESTRA) VALUES ($n)";
        $insert = mysqli_query($conn, $query);
        header('Location: esti_puntual.php');
        $void = false;
    }
    if(!empty($_POST['send'])){
        $n = $_POST['muestra'];
        $query = "INSERT INTO muestras (MUESTRA) VALUES ($n)";
        $insert = mysqli_query($conn, $query);
        header('Location: esti_interva.php');
        $void = false;
    }
?>