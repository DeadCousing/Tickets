<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Ticket.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $ticket= new Ticket();

    switch ($_GET["op"]){
        case "GetTicket":
            $datos = $ticket->getTicket();
            echo json_encode($datos);
        break;

        case "InsertTicket":
            try{
                $datos = $ticket->insertTicket
                ($body["idReporte"],
                $body["idEmpleado"],
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

        case "UpdateTicket":

            try{
                $data = $ticket->findTicket($body["idTicket"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $ticket->updateTicket(
                        $body["idTicket"],
                        $body["idReporte"],
                        $body["idEmpleado"],
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

        case "FindTicket":
            try{
                if ($body["idTicket"]){
                    $datos = $ticket->findTicket($body["idTicket"]);
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

        case "TicketAsignado":

            try{
                $data = $ticket->findTicket($body["idTicket"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $ticket->ticketAsignado(
                        $body["idTicket"]
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

        case "TicketTerminado":

            try{
                $data = $ticket->findTicket($body["idTicket"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $ticket->ticketTerminado(
                        $body["idTicket"]
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