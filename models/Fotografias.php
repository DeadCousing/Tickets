<?php

class Fotografias extends Conectar {
    public function getFotografias() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Fotografias;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findFoto($idFoto){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Fotografias where idFoto = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idFoto);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findFotoTicket($idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Fotografias where idTicket = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idTicket);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertFotografia($fotoEvidencia,$descripcion,$idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $contra = sha1($contrasena);
        $sql = "INSERT Into Fotografias(fotoEvidencia,descripcion,idTicket) VALUES (?,?,?);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$fotoEvidencia);
        $sql->bindValue(2,$descripcion);
        $sql->bindValue(3,$idTicket);
        $sql->execute();
        return true;
    }

    public function updateFotografia($idFoto,$fotoEvidencia,$descripcion,$idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $contra = sha1($contrasena);
        $sql = "UPDATE Fotografias SET 
        fotoEvidencia=?,
        descripcion=?,
        idTicket=?
        WHERE idFoto=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$fotoEvidencia);
        $sql->bindValue(2,$descripcion);
        $sql->bindValue(3,$idTicket);
        $sql->bindValue(4,$idFoto);
        $sql->execute();
        return true;
    }

    public function deleteFoto($idFoto){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM Fotografias WHERE idFoto = ?;"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idRol);
        $sql->execute();
        return true;
    }

}

?>