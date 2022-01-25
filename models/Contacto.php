<?php

    class Contacto extends Conectar {

        public function getOnlyContacto() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Contacto ";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findConctactoCliente($idCliente) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Contacto as co inner join Cliente as cli on (co.idCliente = cli.idClientes) where idCliente = ?; ";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$idCliente);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getContactosCliente() {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Contacto as co inner join Cliente as cli on (co.idCliente = cli.idClientes);";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertContactos($puesto,$nombre,$correo,$telefono,$idCliente) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT Into Contacto (puesto,nombre,correo,telefono,estatus,idCliente) values (?,?,?,?,1,?);"; 
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$puesto);
            $sql->bindValue(2,$nombre);
            $sql->bindValue(3,$correo);
            $sql->bindValue(4,$telefono);
            $sql->bindValue(5,$idCliente);
            $sql->execute();
            return true;
        }

        public function updateContactos($idContactos,$puesto,$nombre,$correo,$telefono) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE Contacto set 
            puesto = ?,
            nombre =?,
            correo = ?,
            telefono = ?
            where idContactos =? ;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$puesto);
            $sql->bindValue(2,$nombre);
            $sql->bindValue(3,$correo);
            $sql->bindValue(4,$telefono);
            $sql->bindValue(5,$idContactos);
            $sql->execute();
            return true;
        }

        public function deactivateContactos($idContactos) {
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE Contacto set estatus = 0 where idContactos = ?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$idContactos);
            $sql->execute();
            return true;
        }
    
        public function activateContactos($idContactos) {
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "UPDATE Contacto set estatus = 1 where idContactos = ?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$idContactos);
            $sql->execute();
            return true;
        }

        public function validarContacto($idContacto) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM Contacto where idContactos = ?; ";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$idContacto);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }


?>