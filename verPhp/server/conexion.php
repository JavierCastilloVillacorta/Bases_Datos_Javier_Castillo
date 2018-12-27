<?php

  class Conexion
  {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "agenda";
    private $conexion;

    function initConexion(){
      $this->conexion = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
      if ($this->conexion->connect_error) {
        return "Error:". $this->conexion->connect_error;
      }else{
        return "OK";
      }
    }

    function cerrarConexion(){
      $this->conexion->close();
    }

    function ejecutarQuery($query){
      return $this->conexion->query($query);
    }


    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $num_campos = array_keys($campos);
      $ultima_key = end($num_campos);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
      $num_tablas = array_keys($tablas);
      $ultima_key = end($num_tablas);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }

    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else{
          $sql .=')';
        }
        $i++;
      }
      $sql .=' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else{
          $sql .= ');';
        }
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }

    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }

    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i < sizeof($data)) {
          $sql .= ', ';
        }else{
          $sql.= ' WHERE '.$condicion.';';
        }
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }
  }



 ?>
