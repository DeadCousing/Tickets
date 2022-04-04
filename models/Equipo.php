<?php

    class Equipo extends Conectar {
        public function getEquipo() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Equipo;";
            $sql = $conectar->prepare($sql);
            $sql ->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function finEquipo($idEquipo) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Equipo where idEquipo = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$idEquipo);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function finNoSerie($noSerie) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Equipo where noSerie = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noSerie);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertEquipo($noSerie,$modelo,$caracateristicas,$descripcion,$idEmpleadoEquipo){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO Equipo(noSerie,modelo,caracateristicas,descripcion,idEmpleadoEquipo) VALUES (?,?,?,?,?);";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noSerie);
            $sql ->bindValue(2,$modelo);
            $sql ->bindValue(3,$caracateristicas);
            $sql ->bindValue(4,$descripcion);
            $sql ->bindValue(5,$idEmpleadoEquipo);
            $sql ->execute();
            return true;
        }

        public function updateEmpleadoUsuario($idEquipo,$noSerie,$modelo,$caracateristicas,$descripcion,$idEmpleadoEquipo){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE Equipo SET
            noSerie = ?,
            modelo = ?,
            caracateristicas = ?,
            descripcion = ?,
            idEmpleadoEquipo = ?
            WHERE idEquipo = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noSerie);
            $sql ->bindValue(2,$modelo);
            $sql ->bindValue(3,$caracateristicas);
            $sql ->bindValue(4,$descripcion);
            $sql ->bindValue(5,$idEmpleadoEquipo);
            $sql ->bindValue(6,$idEquipo);
            $sql ->execute();
            return true;
        }

    }


?>