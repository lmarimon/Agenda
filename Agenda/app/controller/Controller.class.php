<?php
  require_once(__DIR__ . "/../model/ContactDAO.class.php");

  class Controller {
    public static $base_url;
    private $contactDAO;
    // Constructor de la clase
    function __construct(){
        $this->contactDAO = new ContactDAO();
        $ini = parse_ini_file(__DIR__ . "/../url_config.ini");
        self::$base_url = $ini['base_url'] . "web/";
    }
    // Función principal, muestra la fecha y un msg por pantalla
    public function main($msg = ""){
        if ($msg == "") { $msg = '<< Agenda de contactos usando el modelo vista controlador >>'; }
        $params = array(
            'fecha' => date('d-m-y'),
            'mensaje' => $msg
        );
        require __DIR__ . '/../view/inicio.php';
    }
    // Función que llama a viewListContact() con el listado de todos los contactos
    public function list_contactos(){
        if (method_exists('ContactDAO', 'getContactos')){
            $contactos = call_user_func(array($this->contactDAO, 'getContactos'));
            $this->viewListContact($contactos);
        } else { $this->main(); }
    }
    // Función que gestiona la búsqueda por nombre, llama a viewListContact() con el/los contactos que ha encontrado
    public function find_contacto($nombre){
        if (method_exists('ContactDAO', 'findContacto')){
            $contactos = call_user_func(array($this->contactDAO, 'findContacto'), $nombre);
            $this->viewListContact($contactos);
        } else { $this->main(); }
    }
    // Función que muestra el listado de contactos
    private function viewListContact($contactos){
        $tablaContactos = "";
        foreach ($contactos as $contacto){
            $tablaContactos .= "<tr><td>" . $contacto['nombre'] . "</td>";
            $tablaContactos .= "<td>" . $contacto['direccion'] . "</td>";
            $tablaContactos .= "<td>" . $contacto['telefono'] . "</td>";
            $tablaContactos .= "<td><a href='".self::$base_url."eliminar/".$contacto['id']."'>";
            $tablaContactos .= "<img src='img/delete.png' alt='Eliminar' title='Eliminar contacto' /></a></td></tr>";
        }
        require __DIR__ . '/../view/list.php';
    }
    // Función que muestra formulario de alta
    public function form_buscar(){
        require __DIR__ . '/../view/find.php';
    }
    // Función que muestra formulario de búsqueda
    public function form_contacto(){
        require __DIR__ . '/../view/add.php';
    }
    // Función que gestiona la inserción de contactos, devuelve un msg con el resultado
    public function add_contacto($info){
        $msg = "<div class='msg ko'>✘ No se ha podido añadir el contacto.</div>";
        if (method_exists('ContactDAO', 'addContacto')){
            if (call_user_func(array($this->contactDAO, 'addContacto'), $info)){
                $msg = "<div class='msg ok'>✔ Se ha añadido el contacto correctamente.</div>";
            }
        }
        return $msg;
    }
    // Función que gestiona el borrado de contactos, devuelve un msg con el resultado
    public function delete_contacto($id){
        $msg = "<div class='msg ko'>✘ No se ha podido eliminar el contacto.</div>";
        if (method_exists('ContactDAO', 'deleteContacto')){
            if (call_user_func(array($this->contactDAO, 'deleteContacto'), $id)){
                $msg = "<div class='msg ok'>✔ Se ha eliminado el contacto correctamente.</div>";
            }
        }
        return $msg;
    }
  }
?>