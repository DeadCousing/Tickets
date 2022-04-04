<?php
     
    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Equipo.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $equipo = new Equipo();

    switch ($_GET["op"]){

        case "GetEquipo":
            $datos = $equipo->getEquipo();
            echo json_encode($datos);
        break;

        case "FinEquipo":
            try{
                if ($body["idEquipo"]){
                    $datos = $equipo->finEquipo($body["idEquipo"]);
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

        case "InsertEquipo":
            try{
                $datos = $equipo->insertEquipo
                ($body["noSerie"],
                $body["modelo"],
                $body["caracateristicas"],
                $body["descripcion"],
                $body["idEmpleadoEquipo"]
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

        case "UpdateEmpleadoUsuario":

            try{
                $data = $equipo->finEquipo($body["idEquipo"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $equipo->updateEmpleadoUsuario(
                        $body["idEquipo"],
                        $body["noSerie"],
                        $body["modelo"],
                        $body["caracateristicas"],
                        $body["descripcion"],
                        $body["idEmpleadoEquipo"],
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

    }

?>