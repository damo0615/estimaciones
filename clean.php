<?php
    include 'db.php';

    if(empty($_POST['clean'])){
        $query = "DELETE FROM muestras";
        $delete = mysqli_query($conn,$query);
        header('Location: esti_puntual.php');
    }
    elseif(empty($_POST['delete'])){
        $query = "DELETE FROM muestras";
        $delete = mysqli_query($conn,$query);
        header('Location: esti_interva.php');
    }
?>