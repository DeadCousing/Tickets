<?php

    header('Content-Type: application/json');

    require_once("../../config/conexion.php");
    require_once("../../models/Reporte.php");
    require_once("../../models/Equipo.php");
    require_once("../../models/EquipoReporte.php");
    require_once("../../models/EmpleadoUsuario.php");

    $body = json_decode(file_get_contents("php://input"), true);

    $empleadoUsario = new EmpleadoUsario();
    $equipo = new Equipo();
    $reporte = new Reporte();
    $equipoReporte = new EquipoReporte();

    switch ($_GET["op"]){

        case "GetReporte":
            $datos = $reporte->getReporte();
            echo json_encode($datos);
        break;

        case "GetAllReports":
            $datos = $equipoReporte->getAllReports();
            echo json_encode($datos);
        break;

        case "FinReporte":
            try{
                if ($body["idReporte"]){
                    $datos = $reporte->finReporte($body["idReporte"]);
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
                $resultados = $body["data"];
                $array = json_decode(json_encode($resultados), true);

                $datosReporte = $reporte->insertReporte
                ($body["idDireccion"],
                $body["idCliente"],
                $body["fotoEvidencia"],
                $body["fechaCreacion"]);
                
                if ($datosReporte){

                    foreach($array as $value){
 
                        $datosReporte = $empleadoUsario->insertEmpleadoUsuario
                        ($value["noEmpleado"],
                        $value["usuario"],
                        $value["centroTrabajo"],
                        $value["puesto"],
                        $value["departamento"]);

                        if($datosReporte){
                            
                            $datosEquipo = $equipo->insertEquipo
                            ($value["noSerie"],
                            $value["modelo"],
                            $value["caracateristicas"],
                            $value["descripcion"],
                            $value["idEmpleadoEquipo"]);
                            
                            if($datosEquipo){
                                $datosER = $equipoReporte->insertEquipoReporte();

                                if($datosER){
                                    echo json_encode("Registros insertados de manera correcta");
                                }else{
                                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro del detalle! Por favor verificalo o revisa tu solicitud");
                                    echo json_encode($items); 
                                }
                            }else{

                                $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro del Equipo! Por favor verificalo o revisa tu solicitud");
                                echo json_encode($items); 
                            }
                        
                        }else{
                            $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro del empleado! Por favor verificalo o revisa tu solicitud");
                            echo json_encode($items);   
                        }
                        
                    }
                   
                }else{
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al insertar el registro del reporte! Por favor verificalo o revisa tu solicitud");
                    echo json_encode($items);
                }
                
                if ($datosReporte){
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


        case "UpdateReporte":

            try{
                $data = $reporte->finEquipo($body["idEquipo"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este Empleado no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $reporte->updateReporte(
                        $body["idReporte"],
                        $body["idDireccion"],
                        $body["idCliente"],
                        $body["fotoEvidencia"],
                        $body["fechaCreacion"]
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

        case "ReporteAsignado":

            try{
                $data = $reporte->finReporte($body["idReporte"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $reporte->reporteAsignado(
                        $body["idReporte"]
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

        case "ReporteTerminado":

            try{
                $data = $reporte->finReporte($body["idReporte"]);
                if (empty($data)){
                    $items []= array("estado" => "ERROR", "mensaje"=>"Ha ocurrido un error al encontrar el registro! Este cliente no esta registrado");
                    echo json_encode($items);
                }else{
                    $datos = $reporte->reporteTerminado(
                        $body["idReporte"]
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