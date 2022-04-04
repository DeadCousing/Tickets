<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Empleado.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $empleado = new Empleado();

    switch ($_GET["op"]){

        case "GetEmpleado":
            $datos = $empleado->getEmpleado();
            echo json_encode($datos);
        break;

        case "findEmpleado":
            try{
                if ($body["idEmpleado"]){
                    $datos = $empleado->finEmpleado($body["idEmpleado"]);
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

        case "InsertEmpleado":
            try{
                $datos = $empleado->insertEmpleado
                ($body["noEmpleado"],
                $body["nombre"],
                $body["apellidos"],
                $body["telefono"],
                $body["puesto"],
                $body["departamento"],
                $body["correo"],
                $body["idUsuario"]
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

        case "UpdateEmpleado":

            try{
                $data = $empleado->finEmpleado($body["idEmpleado"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $empleado->updateEmpleado(
                        $body["idEmpleado"],
                        $body["noEmpleado"],
                        $body["nombre"],
                        $body["apellidos"],
                        $body["telefono"],
                        $body["puesto"],
                        $body["departamento"],
                        $body["correo"],
                        $body["idUsuario"]
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