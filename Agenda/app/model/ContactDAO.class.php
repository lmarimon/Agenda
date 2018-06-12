<?php
  require_once("Contact.class.php");
  
  class ContactDAO {
    private $db;
    private $contactos;
    // Constructor de la clase
    function __construct(){
      $this->contactos = array();
      $this->connect();
    }
    // Función que guarda la conexión con la BBDD (usando un fichero INI para obtener los parámetros)
    private function connect(){
      $ini = parse_ini_file(__DIR__ . "/../bd_config.ini");
      $this->bd = new mysqli($ini['db_host'].":".$ini['db_port'], $ini['db_user'], $ini['db_pwd'], $ini['db_name']);
      if ($this->bd->connect_error) { die("Connection failed: " . $this->bd->connect_error); }
    }
    // Función que devuelve todos los contactos de la BBDD
    public function getContactos(){
      $contactos = $this->bd->query("SELECT * FROM contacto;");
      if ($contactos->num_rows > 0) {
        while($row = $contactos->fetch_assoc()){
          $contacto = new Contact();
          $contacto = $row;
          array_push($this->contactos, $contacto);
        }
      }
      return $this->contactos;
    }
    // Función que busca en la BBDD, pasamos el nombre por parámetro y nos devuelve una lista con las coincidencias
    public function findContacto($nombre){
      $contactos = $this->bd->query("SELECT * FROM contacto WHERE nombre LIKE '%" . $nombre . "%';");
      if ($contactos->num_rows > 0) {
        while($row = $contactos->fetch_assoc()){
          $contacto = new Contact();
          $contacto = $row;
          array_push($this->contactos, $contacto);
        }
      }
      return $this->contactos;
    }
    // Función que añade registro en la BBDD, pasamos la info por parámetro y nos devuelve true/false
    public function addContacto($info){
      $query = "INSERT INTO contacto (nombre, direccion, telefono) VALUES (?, ?, ?)";
      $stmt = $this->bd->prepare($query);
      $stmt->bind_param("ssi", $info['nombre'], $info['direccion'], $info['telefono']);
      $stmt->execute();
      $num_filas = $stmt->affected_rows;
      $stmt->close();
      if ($num_filas > 0){ return true; }
      return false;
    }
    // Función que borra registro de la BBDD, pasamos el id por parámetro y nos devuelve true/false
    public function deleteContacto($id){
      $query = "DELETE FROM contacto WHERE id=?;";
      $stmt = $this->bd->prepare($query);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $num_filas = $stmt->affected_rows;
      $stmt->close();
      if ($num_filas > 0){ return true; }
      return false;
    }
  }
?>