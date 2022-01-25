<?php

    header('Content-Type: application/json');


    require_once("../config/conexion.php");
    require_once("../models/Contacto.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $contacto = new Contacto();

    switch($_GET["op"]){

        case "GetAllContacto":
            $datos = $contacto->getOnlyContacto();
            echo json_encode($datos);
        break;
        
        case "GetContactoCliente":
            $datos = $contacto->getContactosCliente();
            echo json_encode($datos);
        break;

        case "FindContacto":
            try{
                if ($body["idClientes"]){
                    $datos = $contacto->findConctactoCliente($body["idClientes"]);
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

        case "InsertContacto":
            try{
                $datos = $contacto->insertContactos(
                $body["puesto"],
                $body["nombre"],
                $body["correo"],
                $body["telefono"],
                $body["idCliente"],
            );
                if ($datos){
                    echo json_encode("Registro insertado de manera correcta");
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

        case "UpdateContacto":

            try{
                $data = $contacto->validarContacto($body["idContacto"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $contacto->updateContactos(
                        $body["idContacto"],
                        $body["puesto"],
                        $body["nombre"],
                        $body["correo"],
                        $body["telefono"]
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

        case "DeactivateContacto":

            try{
                $data = $contacto->validarContacto($body["idContacto"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $contacto->deactivateContactos(
                        $body["idContacto"]
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

        case "ActivateContacto":

            try{
                $data = $contacto->validarContacto($body["idContacto"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $contacto->activateContactos(
                        $body["idContacto"]
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