<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Usuario.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $usuario = new Usuario();

    switch ($_GET["op"]){

        case "GetUsuario":
            $datos = $usuario->getUsuario();
            echo json_encode($datos);
        break;

        case "GetUsersRol":
            $datos = $usuario->getUsersRol();
            echo json_encode($datos);
        break;

        case "findUsuario":
            try{
                if ($body["idUsuario"]){
                    $datos = $usuario->findUsuario($body["idUsuario"]);
                    if (empty($datos)){
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al buscar el registro! Por favor verificalo o revisa tu solicitud");
                        echo json_encode($items);
                    }
                    echo json_encode($datos);
                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al buscar el registro! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al buscar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);
            }

        break;

        case "InsertUsuario":
            try{
                $datos = $usuario->insertUsuario
                ($body["usuario"],
                $body["contrasena"]
            );
                if ($datos){
                    $insUserRol =$usuario-> insertUsuarioRol();
                    if($insUserRol){
                        echo json_encode("Registro insertado de manera correcta");
                    }else{
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro intermedio! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                    }

                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al insertar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }
        break;

        case "UpdateUsuario":

            try{
                $data = $usuario->findUsuario($body["idUsuario"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $usuario->updateUsuario(
                        $body["idUsuario"],
                        $body["usuario"],
                        $body["contrasena"]
                    );
                    if ($datos){
                        echo json_encode("Registro actualizado de manera correcta");
                    }else{
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al actualizar el registro! Por favor verificalo o revisa tu solicitud");
                        echo json_encode($items);
                    }
                    
                }

            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al actualizar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }

        break;

        case "activateUsuario":

            try{
                $data = $usuario->findUsuario($body["idUsuario"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $usuario->activateUsuario(
                        $body["idUsuario"]
                    );
                    if ($datos){
                        echo json_encode("Registro desactivado de manera correcta");
                    }else{
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al desactivar el registro! Por favor verificalo o revisa tu solicitud");
                        echo json_encode($items);
                    }
                    
                }

            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al desactivar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }

        break;

        case "DeactivateUsuario":

            try{
                $data = $usuario->findUsuario($body["idUsuario"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $usuario->deactivateUsuario(
                        $body["idUsuario"]
                    );
                    if ($datos){
                        echo json_encode("Registro activado de manera correcta");
                    }else{
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al activar el registro! Por favor verificalo o revisa tu solicitud");
                        echo json_encode($items);
                    }
                    
                }

            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al activar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }

        break;
    }
?>