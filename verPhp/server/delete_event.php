<?php
  session_start();
  require('conexion.php');

  if (isset($_SESSION['id'])) {
    $conexion = new Conexion();
    if ($conexion->initConexion() == 'OK') {
      $condicion = 'id = '. $_POST['id'] ;
        $respuesta['condicion'] = $condicion;
      if ($conexion->eliminarRegistro('eventos',$condicion)) {
        $respuesta['msg']= "OK";
      }else {
        $respuesta['msg']= "Error - Al Eliminar Evento";
      }

    }else{
      $respuesta['msg']= "Error - Sin Conexion";
    }
  }else{
    $respuesta['msg']= "Error Sin-Session";
  }
  echo json_encode($respuesta);
 ?>
