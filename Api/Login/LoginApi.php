<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Login.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $login = new Login();

    switch ($_GET["op"]){
        
        case "Login":
            try{
                $datos = $login->login
                ($body["usuario"],
                $body["contrasena"]
            );
                if ($datos){
                    echo json_encode("Inicio de sesion exitoso");
                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error iniciar sesion! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error en el inicio de sesion!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }
        break;
        
        case "Logout":
            try{
                $datos = $login->logout
                ($body["token"]
            );
                if ($datos){
                    echo json_encode("Cierre de sesion exitoso");
                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error cerrar sesion! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error en el cierre de sesion!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }
        break;
        
        case "ValidarToken":
            try{
                $datos = $login->validarToken
                ($body["token"]
            );
                if ($datos){
                    echo json_encode("Token validado con exito");
                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error token inexistente! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error en la busqueda del token!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }
        break;
    }

?>