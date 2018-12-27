<?php
  session_start();
  require('conexion.php');


  if (isset($_SESSION['id'])) {
    $conexion = new Conexion();
    if ($conexion->initConexion() == 'OK') {

      $datos['titulo'] = "'".$_POST['titulo']."'";
      $datos['fechaInicio'] = "'".$_POST['start_date']."'";
      $datos['horaInicio'] = "'".$_POST['start_hour']."'";
      $datos['fechaFin'] = "'".$_POST['end_date']."'";
      $datos['horaFin'] = "'".$_POST['end_hour']."'";
      $datos['idUsuario'] = "'".$_SESSION['id']."'";

      if ($datos['titulo'] == "''" || $datos['fechaInicio'] == "''") {
        $respuesta['msg']= "Titulo - Fecha Inicio : Obligatorios";
      }else{
        if ($conexion->insertData('eventos',$datos)) {
          $respuesta['msg']= "OK";
        }else{
          $respuesta['msg']= "Error - Inserción de dato";
        }
      }

    }else {
      $respuesta['msg']= "Error - Sin Conexion";
    }

  }else{
    $respuesta['msg']= "Error Sin-Session";
  }

  echo json_encode($respuesta);

 ?>
