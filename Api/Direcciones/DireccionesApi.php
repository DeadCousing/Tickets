<?php

    header('Content-Type: application/json');


    require_once("../../config/conexion.php");
    require_once("../../models/Direcciones.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $Direcciones = new Domicilios();

    switch($_GET["op"]){
        case "GetAllDomicilio":
            $datos = $Direcciones->getDomicilios();
            echo json_encode($datos);
        break;
        
        case "GetDomicilioCliente":
            $datos = $Direcciones->getallDOmiciliosCliente();
            echo json_encode($datos);
        break;

        case "FindDomicilio":
            try{
                if ($body["idDomicilio"]){
                    $datos = $Direcciones->findDomicilio($body["idClientes"]);
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

        case "InsertDomicilio":
            try{
                $datos = $Direcciones->insertDomicilios(
                $body["descripcion"],
                $body["calle"],
                $body["numeroInt"],
                $body["numeroExt"],
                $body["colonia"],
                $body["cp"],
                $body["telExt"],
                $body["correo"],
                $body["ubicacionMaps"],
                $body["cruces"],
                $body["idCliente"],
                $body["idContacto"],
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

        case "UpdateDomicilio":

            try{
                $data = $Direcciones->findDomicilio($body["idContacto"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $Direcciones->updateDomicilios(
                        $body["idDireccion"],
                        $body["descripcion"],
                        $body["calle"],
                        $body["numeroInt"],
                        $body["numeroExt"],
                        $body["colonia"],
                        $body["cp"],
                        $body["telExt"],
                        $body["correo"],
                        $body["ubicacionMaps"],
                        $body["cruces"],
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

        case "DeactivateDomicilio":

            try{
                $data = $Direcciones->findDomicilio($body["idDireccion"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $Direcciones->deactivateDomicilio(
                        $body["idDireccion"]
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

        case "ActivateDomicilio":

            try{
                $data = $Direcciones->activateDomicilio($body["idDireccion"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $Direcciones->activateContactos(
                        $body["idDireccion"]
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