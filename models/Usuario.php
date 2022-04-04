<?php

class Usuario extends Conectar {

    public function getUsuario() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Usuario;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUsuario($idUsuario){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Usuario where idUsuario = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idUsuario);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUsuario($usuario,$contrasena){
        $conectar = parent::conexion();
        parent::set_names();
        $contra = sha1($contrasena);
        $sql = "INSERT Into Usuario(usuario,contraseña) VALUES (?,?);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$usuario);
        $sql->bindValue(2,$contra);
        $sql->execute();
        return true;
    }

    public function updateUsuario($idUsuario,$usuario,$contrasena){
        $conectar = parent::conexion();
        parent::set_names();
        $contra = sha1($contrasena);
        $sql = "UPDATE Usuario SET 
        usuario=?,
        contrasena=?
        WHERE idUsuario=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$usuario);
        $sql->bindValue(2,$contra);
        $sql->bindValue(3,$idUsuario);
        $sql->execute();
        return true;
    }

    public function activateUsuario($idUsuario){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Usuario SET 
        estatus=1,
        WHERE idUsuario=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idUsuario);
        $sql->execute();
        return true;
    }

    public function deactivateUsuario($idUsuario){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Usuario SET 
        estatus=0,
        WHERE idUsuario=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idUsuario);
        $sql->execute();
        return true;
    }

    public function insertUsuarioRol(){
        $conectar = parent::conexion();
        parent::set_names();

        $idUsuario = "SELECT MAX(idUsuario) AS idUsuario FROM Usuario;";
        $idUsuario = $conectar->prepare($sql);
        $idUsuario ->execute();

        $idRol = "SELECT MAX(idRol) AS idRol FROM Rol;";
        $idRol = $conectar->prepare($sql);
        $idRol ->execute();

        $sql = "INSERT INTO usuarioRol(idUsuario,idRol) VALUES(?,?);";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idUsuario);
        $sql ->bindValue(2,$idRol);
        $sql ->execute();
        return true;
    }

    public function getUsersRol(){

        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM usuarioRol AS ur INNER JOIN Usuario AS u on (ur.idUsuario = u.idUsuario) INNER JOIN Rol as r on (ur.idRol = r.idRol);";
        $sql = $conectar->prepare($sql);
        $sql ->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>