<?php
  session_start();
  require('conexion.php');


  if (isset($_SESSION['id'])) {
    $conector = new Conexion();
    $conexion = $conector->initConexion();
    if ($conexion == 'OK') {

      $datos['titulo'] = "'".$_POST['titulo']."'";
      $datos['fechaInicio'] =  "'".$_POST['start_date']."'";
      $datos['horaInicio'] = "'".$_POST['start_hour']."'";
      $datos['fechaFin'] = "'".$_POST['end_date']."'";
      $datos['horaFin'] = "'".$_POST['end_hour']."'";
      $datos['idUsuario'] = "'".$_SESSION['id']."'";

      if ($datos['titulo'] == "''" || $datos['fechaInicio'] == "''") {
        $respuesta['msg']= "Titulo - Fecha Inicio : Obligatorios";
      }else{
        if ($conector->insertData('eventos',$datos)) {
          $respuesta['msg']= "OK";
          $respuesta["idEvento"] = $conector->conexion->insert_id;
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
  $conector->cerrarConexion();
  echo json_encode($respuesta);

 ?>
