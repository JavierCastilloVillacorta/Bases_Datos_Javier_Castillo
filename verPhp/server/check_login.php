<?php
  session_start();
  require('./conexion.php');

  $conexion=new Conexion();
  $respuesta['conexion'] = $conexion->initConexion();

  if ($respuesta['conexion'] == "OK") {
    $consulta = $conexion->consultar(['usuarios'],
    ['id','nombre','email','password'], 'WHERE email="'.$_POST['username'].'"');

    if ($consulta->num_rows != 0) {
      $fila = $consulta->fetch_assoc();
      if(password_verify( $_POST['password'] ,$fila['password'])){
        $respuesta['msg']="OK";
        $_SESSION['id']=$fila['id'];
        $_SESSION['nombre']=$fila['nombre'];
        $_SESSION['email']=$fila['email'];
      }else{
        $respuesta['msg']="Contraseña Incorrecta";
      }
    }else{
      $respuesta['msg']="Email Incorrecto";
    }
  }
  echo json_encode($respuesta);
 ?>
