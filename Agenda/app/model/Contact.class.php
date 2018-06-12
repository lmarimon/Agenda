<?php
  class Contact {
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    // GETters y SETters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getDireccion() { return $this->direccion; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function getTelefono() { return $this->telefono; }
    public function setTelefono($id) { $this->telefono = $telefono; }
  }
?>