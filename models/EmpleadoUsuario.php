<?php

    class EmpleadoUsuario extends Conectar {
        public function getEmpleadoUsuario() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM EmpleadoUsuario;";
            $sql = $conectar->prepare($sql);
            $sql ->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function finEmpleadoUsuario($idEmpleadoUsuario) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM EmpleadoUsuario where idEmpleadoEquipo = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$idEmpleadoUsuario);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function finNoEmpleado($noEmpleado) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM EmpleadoUsuario where noEmpleado = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noEmpleado);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertEmpleadoUsuario($noEmpleado,$usuario,$centroTrabajo,$puesto,$departamento){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO EmpleadoUsuario(noEmpleado,usuario,centroTrabajo,puesto,departamento) VALUES (?,?,?,?,?);";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noEmpleado);
            $sql ->bindValue(2,$usuario);
            $sql ->bindValue(3,$centroTrabajo);
            $sql ->bindValue(4,$puesto);
            $sql ->bindValue(5,$departamento);
            $sql ->execute();
            return true;
        }

        public function updateEmpleadoUsuario($idEmpleadoUsuario,$noEmpleado,$usuario,$centroTrabajo,$puesto,$departamento){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE EmpleadoUsuario SET
            noEmpleado = ?,
            usuario = ?,
            centroTrabajo = ?,
            puesto = ?,
            departamento = ?
            WHERE idEmpleadoUsuario = ?;";
            $sql =$conectar->prepare($sql);
            $sql ->bindValue(1,$noEmpleado);
            $sql ->bindValue(2,$usuario);
            $sql ->bindValue(3,$centroTrabajo);
            $sql ->bindValue(4,$puesto);
            $sql ->bindValue(5,$departamento);
            $sql ->bindValue(5,$idEmpleadoUsuario);
            $sql ->execute();
            return true;
        }

    } 


?>