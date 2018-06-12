<?php
  require_once(__DIR__ . "/../app/controller/Controller.class.php");
  // login externo
  //include_once("login.php");
  
  //if (isset($_SESSION['id'])) {
    // enrutamiento
    $map = array(
      'inicio' => array('controller' =>'Controller', 'action' =>'main'),
      'listar' => array('controller' =>'Controller', 'action' =>'list_contactos'),
      'insertar' => array('controller' =>'Controller', 'action' =>'form_contacto'),
      'insertDB' => array('controller' =>'Controller', 'action' =>'add_contacto'),
      'buscar' => array('controller' =>'Controller', 'action' =>'form_buscar'),
      'resultado' => array('controller' =>'Controller', 'action' =>'find_contacto'),
      'eliminar' => array('controller' =>'Controller', 'action' =>'delete_contacto')
    );

    // parseo de la ruta
    $ruta = 'inicio';
    if (isset($_GET['action'])) {
      if (isset($map[$_GET['action']])) {
          $ruta = $_GET['action'];
      } else {
          header('Status: 404 Not Found');
          echo '<html><body><h1>Error 404: No existe la ruta <i>'.$_GET['action'].'</i></p></body></html>';
          exit;
      }
    }

    $controlador = $map[$ruta];

    // ejecución del controlador asociado a la ruta
    if (method_exists($controlador['controller'], $controlador['action'])) {
      switch ($controlador['action']){
          case 'add_contacto':
              $name = filter_input(INPUT_POST, 'name');
              $dire = filter_input(INPUT_POST, 'dire');
              $telf = filter_input(INPUT_POST, 'telf');
              $info = array('nombre'=>$name, 'direccion'=>$dire, 'telefono'=>$telf);
              $message = call_user_func(array(new $controlador['controller'], $controlador['action']), $info);
              call_user_func(array(new $controlador['controller'], 'main'), $message);
              break;
          case 'find_contacto':
              $find_name = filter_input(INPUT_POST, 'find_name');
              call_user_func(array(new $controlador['controller'], $controlador['action']), $find_name);
              break;
          case 'delete_contacto':
              $id = filter_input(INPUT_GET, 'id');
              $message = call_user_func(array(new $controlador['controller'], $controlador['action']), $id);
              call_user_func(array(new $controlador['controller'], 'main'), $message);
              break;
          default:
              call_user_func(array(new $controlador['controller'], $controlador['action']));
      }
    } else {
      header('Status: 404 Not Found');
      echo '<html><body><h1>Error 404: El controlador <i>'.$controlador['controller'].'->'.$controlador['action'].'</i> no existe</h1></body></html>';
    }
  //}
?>