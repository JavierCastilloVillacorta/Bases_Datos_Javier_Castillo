<?php
  session_start();
  require('conexion.php');

  if (isset($_SESSION['id'])) {
    $conexion = new Conexion();
    if ($conexion->initConexion() == 'OK'){

      $datos['fechaInicio'] = "'".$_POST['start_date']."'";
      $datos['fechaFin'] =  "'".$_POST['end_date']."'";
      $datos['horaInicio'] =  "'".$_POST['start_hour']."'";
      $datos['horaFin'] =  "'".$_POST['end_hour']."'";

      $condicion = 'id = '.$_POST['id'];

      if ($conexion->actualizarRegistro('eventos',$datos, $condicion)) {
        $respuesta['msg']= "OK";
      }else{
        $respuesta['msg']= "Error - Actualizar dato";
      }

    }else {
      $respuesta['msg']= "Error - Sin Conexion";
    }
  }else{
    $respuesta['msg']= "Error Sin-Session";
  }

  echo json_encode($respuesta);

 ?>
