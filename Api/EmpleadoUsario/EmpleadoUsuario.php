<?php
    
    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/EmpleadoUsuario.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $empleadoUsario = new EmpleadoUsario();

    switch ($_GET["op"]){

        case "GetEmpleadoUsuario":
            $datos = $empleadoUsario->getEmpleadoUsuario();
            echo json_encode($datos);
        break;

        case "FinEmpleadoUsuario":
            try{
                if ($body["idEmpleadoUsuario"]){
                    $datos = $empleadoUsario->finEmpleadoUsuario($body["idEmpleadoUsuario"]);
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

        case "InsertEmpleadoUsuario":
            try{
                $datos = $empleadoUsario->insertEmpleadoUsuario
                ($body["noEmpleado"],
                $body["usuario"],
                $body["centroTrabajo"],
                $body["puesto"],
                $body["departamento"],
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
                $data = $empleadoUsario->finEmpleadoUsuario($body["idEmpleadoUsuario"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $empleadoUsario->updateEmpleadoUsuario(
                        $body["idEmpleadoUsuario"],
                        $body["noEmpleado"],
                        $body["usuario"],
                        $body["centroTrabajo"],
                        $body["puesto"],
                        $body["departamento"],
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