<?php // creacion de  3 usuarios para Agenda

  $conexion = new mysqli('localhost','root','','agenda');
  if ($conexion->connect_error) {
    echo "Error:" . $conexion->connect_error;
  }else {
    // Descomentar para entrega de examen 
    //$sql = "INSERT INTO usuarios(nombre, email, password) VALUES (?,?,?)";
    $insert = $conexion->prepare($sql);
    $insert->bind_param("sss",$nombre,$email,$password);

    $nombre = "Juan";
    $email = "juan@gmail.com";
    $password = password_hash("123456", PASSWORD_DEFAULT);
    $insert->execute();

    $nombre = "Carlos";
    $email = "carlos@gmail.com";
    $password = password_hash("123456", PASSWORD_DEFAULT);
    $insert->execute();

    $nombre = "Pedro";
    $email = "pedro@gmail.com";
    $password = password_hash("123456", PASSWORD_DEFAULT);
    $insert->execute();

    $conexion->close();

    echo "Usuarios Creados";
  }

 ?>
