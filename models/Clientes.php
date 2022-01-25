<?php

class Clientes extends Conectar {
    public function getClientes() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Cliente;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findClientes($idClientes) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Cliente where idClientes = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idClientes);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertClientes($rfc,$razonSocial,$nombre) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Cliente(rfc,razonsocial,nombre,estatus) VALUES (?,?,?,1);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$rfc);
        $sql->bindValue(2,$razonSocial);
        $sql->bindValue(3,$nombre);
        $sql->execute();
        return true;
    }
    
    public function updateClientes($idCliente,$rfc,$razonSocial,$nombre) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Cliente SET 
        rfc= ?,
        razonsocial = ?,
        nombre = ? 
        WHERE idClientes = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$rfc);
        $sql->bindValue(2,$razonSocial);
        $sql->bindValue(3,$nombre);
        $sql->bindValue(4,$idCliente);
        $sql->execute();
        return true;
    }

    public function deactivateCliente($idCliente) {
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "UPDATE Cliente set estatus = 0 where idClientes = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idCliente);
        $sql->execute();
        return true;
    }

    public function activateCliente($idCliente) {
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "UPDATE Cliente set estatus = 1 where idClientes = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idCliente);
        $sql->execute();
        return true;
    }

    
}

?>