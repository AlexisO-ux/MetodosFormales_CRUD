<?php

session_start();

$nombre ='';
$cantidad='';
$precio='';
$update=false;
$id=0;

//Conexion a BD
$mysqli = new mysqli('localhost','root','','bd') or die(mysqli_error($mysqli));


//Insert
if(isset($_POST['guardar'])){

    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    

    $mysqli->query("INSERT INTO productos (Nombre,Cantidad,Precio) VALUES('$nombre','$cantidad','$precio')") or die($mysqli->error);
    
    $_SESSION['message']="Los cambios han sido guardados";
    $_SESSION['msg_type']="success";

    header("location: inventario.php");
}

//Delete
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM productos WHERE id=$id") or die ($mysqli->error);

    $_SESSION['message']="Los campos se borraron ";
    $_SESSION['msg_type']="danger";

    header("location: inventario.php");
}

//Editar
if(isset($_GET['edit'])){

    $update=true;
    $id = $_GET['edit'];

    $result = $mysqli->query("SELECT * FROM productos WHERE id=$id") or die ($mysqli->error);

     $row = $result->fetch_array();
      $nombre  = $row['Nombre'];
      $cantidad = $row['Cantidad'];
      $precio = $row['Precio'];

    
}

//Actualizar
if(isset($_POST['id'])){

    $id=$_POST['id'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $mysqli->query("UPDATE productos set Nombre='$nombre', Cantidad='$cantidad', Precio='$precio' WHERE id=$id") or die ($mysqli->error);

    $_SESSION['message']="Los campos se actualizaron ";
    $_SESSION['msg_type']="warning";

    header("location: inventario.php");
}