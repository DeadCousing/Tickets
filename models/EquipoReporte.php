<?php

    class EquipoReporte extends Conectar {

        public function insertEquipoReporte(){
            $conectar = parent::conexion();
            parent::set_names();

            $idReporte = "SELECT MAX(idReporte) AS idReporte FROM Reporte;";
            $idReporte = $conectar->prepare($sql);
            $idReporte ->execute();

            $idEquipo = "SELECT MAX(idEquipo) AS idEquipo FROM Equipo;";
            $idEquipo = $conectar->prepare($sql);
            $idEquipo ->execute();

            $sql = "INSERT INTO EquipoReporte(idReporte,idEquipo) VALUES(?,?);";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$idReporte);
            $sql ->bindValue(2,$idEquipo);
            $sql ->execute();
            return true;
        }

        public function getAllReports(){

            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM EquipoReporte AS er INNER JOIN Reporte AS r on (er.idReporte = r.idReporte) INNER JOIN Equipo as e on (er.idEquipo = e.idEquipo) inner join EmpleadoUsuario as eu on (e.idEmpleadoEquipo = eu.idEmpleadoEquipo);";
            $sql = $conectar->prepare($sql);
            $sql ->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>