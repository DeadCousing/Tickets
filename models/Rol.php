<?php

class Rol extends Conectar {
    public function getRol() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Rol;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function finRol($idRol){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Rol where idRol = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idRol);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertRol($nombre,$descripcion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Rol(nombre,descripcion) VALUES (?,?);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$nombre);
        $sql->bindValue(2,$descripcion);
        $sql->execute();
        return true;
    }

    public function updateRol($idRol,$nombre,$descripcion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Rol SET 
        nombre=?,
        descripcion=?
        WHERE idRol=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$nombre);
        $sql->bindValue(2,$descripcion);
        $sql->bindValue(3,$idRol);
        $sql->execute();
        return true;
    }

    public function deleteRol($idRol){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM Rol WHERE idRol = ?;"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idRol);
        $sql->execute();
        return true;
    }

}


?>