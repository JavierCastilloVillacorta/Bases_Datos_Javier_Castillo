<?php
  session_start();

  if (isset($_SESSION['id'])) {
    require('conexion.php');
    $conexion = new Conexion();
    if ($conexion->initConexion() == 'OK') {
      $consulta = $conexion->consultar(['eventos'],
      ['id','titulo','fechaInicio','horaInicio','fechaFin','horaFin','idUsuario'],
      'WHERE idUsuario="'.$_SESSION['id'].'"');
      $eventos=array();
      if ($consulta->num_rows != 0) {

        while ($fila = $consulta->fetch_assoc()) {
          $evento = array(
            'id'=> $fila['id'],
            'fk_usuario'=>$fila['idUsuario'],
            'title'=> $fila['titulo'],
            'start'=> $fila['fechaInicio'].' '.$fila['horaInicio'],
            'end'=> $fila['fechaFin'].' '.$fila['horaFin']);
          array_push($eventos, $evento);
        }
        $respuesta['eventos'] = $eventos;
        $respuesta['msg'] = 'OK';
      }else{
        $respuesta['msg'] = 'OK';
      }

    }else{
      $respuesta['msg'] = 'Error - Sin Conexion';
    }
  }else{
    $respuesta['msg'] = 'Error - Sin Session';
  }

  echo json_encode($respuesta);

 ?>
