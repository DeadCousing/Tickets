<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $rol= new Rol();

    switch ($_GET["op"]){

        case "GetRol":
            $datos = $rol->getRol();
            echo json_encode($datos);
        break;

        case "FinRol":
            try{
                if ($body["idRol"]){
                    $datos = $rol->finRol($body["idRol"]);
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

        
        case "InsertRol":
            try{
                $datos = $rol->insertRol
                ($body["nombre"],
                $body["descripcion"]
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

        case "UpdateRol":

            try{
                $data = $rol->finRol($body["idRol"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $rol->updateRol(
                        $body["idRol"],
                        $body["nombre"],
                        $body["descripcion"]
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

        case "DeleteRol":

            try{
                $data = $rol->finRol($body["idRol"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $rol->deleteRol(
                        $body["idRol"]
                    );
                    if ($datos){
                        echo json_encode("Registro eliminado de manera correcta");
                    }else{
                        $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al eliminar el registro! Por favor verificalo o revisa tu solicitud");
                        echo json_encode($items);
                    }
                    
                }

            }catch(Exception $e){
                $items []= array("estado" => "ERROR",
                "mensaje"=>"Ha ocurrido un error al eliminar el registro!  Por favor verificalo con un administrador o revisa tu solicitud",
                "excepción" =>$e);
                echo json_encode($items);   
            }

        break;

    }
?>