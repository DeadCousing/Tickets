<?php

    header('Content-Type: application/json');


    require_once("../config/conexion.php");
    require_once("../models/Clientes.php");

    $body = json_decode(file_get_contents("php://input"), true);


    $clientes = new Clientes();

     switch($_GET["op"]){

        case "GetAllClient":
            $datos = $clientes->getClientes();
            echo json_encode($datos);
        break;

        case "FindCliente":
            try{
                if ($body["idClientes"]){
                    $datos = $clientes->findClientes($body["idClientes"]);
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

        case "InsertCliente":
            try{
                $datos = $clientes->insertClientes
                ($body["rfc"],
                $body["razonSocial"],
                $body["nombre"]);
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

        case "UpdateCliente":

            try{
                $data = $clientes->findClientes($body["idClientes"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $clientes->updateClientes(
                        $body["idClientes"],
                        $body["rfc"],
                        $body["razonSocial"],
                        $body["nombre"]
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

        case "DeactivateCliente":

            try{
                $data = $clientes->findClientes($body["idClientes"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $clientes->deactivateCliente(
                        $body["idClientes"]
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

        case "ActivateCliente":

            try{
                $data = $clientes->findClientes($body["idClientes"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $clientes->activateCliente(
                        $body["idClientes"]
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