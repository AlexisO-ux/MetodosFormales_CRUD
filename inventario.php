<!doctype html>
<html>
    <head>
        <title>CRUD</title>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            
            <nav class="navbar navbar-exppand-lg navbar-dark bg-dark" >
                <a class="navbar-brand" href="#">Aries</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="index.php">Inicio </a>
                        <a class="nav-item nav-link" href="inventario.php">Inventario</a>     
                    </div>
                </div>
                </nav>
            </nav>
    <body style="background-color: #d3d3d3">
  

        
        <?php require_once 'process.php'; ?>

        <?php

        //EL MENSAJE DE PELIGRO NO SE MUESTRA, TERMINARLO
        
        if(isset($_SESSION['message'])):?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
            //Mostrar el mensaje de los cambios
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>

        </div>
        <?php endif ?>
        
        <div class="container">

        <?php $mysqli = new mysqli('localhost','root','','bd') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM productos");
        
        ?>
        <div class="row"><!-- <div class="row justify-content-left"> -->
            <div class="col-7">
                <table class="table">
                    <thead>
                        
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                        
                    </thead>
                    <?php
                        //extraccion y visualizacion
                        while($row=$result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Nombre'];?></td>
                        <td><?php echo $row['Cantidad'];?></td>
                        <td><?php echo $row['Precio'];?></td>
                        <td>
                            <a href="inventario.php?edit=<?php echo $row['Id']; ?>" class="btn btn-info">Editar</a>
                            <a href="inventario.php?delete=<?php echo $row['Id']; ?>" class="btn btn-danger">Borrar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        
            <?php
            pre_r($result->fetch_assoc());

            function pre_r($array){
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }

             ?>
        
            <!--<div class="col" >  <div class="row justify-content-left">-->
            <div class="col-3" >
                <form action="process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id?>">

                    <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Ingresa el nombre" class="form-control" require 
                        value=" <?php echo $nombre ?>">
                    </div>

                    <div class="form-group">
                    <label>Cantidad</label>
                    <input type="text" name="cantidad" placeholder="Ingresa la cantidad" class="form-control" require
                        value=" <?php echo $cantidad ?>">
                    </div>

                    <div class="form-group">
                    <label>Precio</label>
                    <input type="text" name="precio" placeholder="Ingresa el precio" class="form-control" require
                        value=" <?php echo $precio ?>">
                    </div>

                    <div class="form-group">
                    <?php if ($update==true):?>
                    <button type="submit" name="actualizar" class="btn btn-primary" >Actualizar</button>
                    <?php else:?>
                    <button type="submit" name="guardar" class="btn btn-primary" >Guardar</button>
                    <?php endif ?>
                    </div>

                </form>
            </div>
        </div>
    </body>