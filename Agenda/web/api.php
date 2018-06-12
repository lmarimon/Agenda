<?php
    // parte imprescindible definir el tipo de dato a devolver en el msg
    header("Content-Type:application/json");
    require_once("../app/model/ContactDAO.class.php");

    // método post para insertar registro en la BBDD
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = filter_input(INPUT_POST, 'nombre');
        $dire = filter_input(INPUT_POST, 'direccion');
        $telf = filter_input(INPUT_POST, 'telefono');
        $info = array('nombre'=>$name, 'direccion'=>$dire, 'telefono'=>$telf);
        $input = call_user_func(array(new ContactDAO, 'addContacto'), $info);
        if ($input){ response(201, "Created OK", $input); }
        else { response(201, "Created KO", $input); }
    }

    function response($status, $status_message, $data){
        header("HTTP/1.1 " . $status);
        $response['status'] = $status;
        $response['status_message'] = $status_message;
        $response['data'] = $data;
        $json_response = json_encode($response);
        echo $json_response;
    } 
?>