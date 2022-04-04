<?php

class Empleado extends Conectar {
    public function getEmpleado() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Empleado;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function finEmpleado($idEmpleado){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Empleado where idEmpleado = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idEmpleado);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertEmpleado($noEmpleado,$nombre,$apellidos,$telefono,$puesto,$departamento,$correo,$idUsuario){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Empleado(noEmpleado,nombre,apellidos,telefono,puesto,departamento,correo,idUsuario) VALUES (?,?,?,?,?,?,?,?);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$noEmpleado);
        $sql->bindValue(2,$nombre);
        $sql->bindValue(3,$apellidos);
        $sql->bindValue(4,$telefono);
        $sql->bindValue(5,$puesto);
        $sql->bindValue(6,$departamento);
        $sql->bindValue(7,$correo);
        $sql->bindValue(8,$idUsuario);
        $sql->execute();
        return true;
    }

    public function updateEmpleado($idEmpleado,$noEmpleado,$nombre,$apellidos,$telefono,$puesto,$departamento,$correo,$idUsuario){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Empleado SET 
        noEmpleado=?,
        nombre=?,
        apellidos=?,
        telefono=?,
        puesto=?,
        departamento=?,
        correo=?,
        idUsuario=?
        WHERE idEmpleado=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$noEmpleado);
        $sql->bindValue(2,$nombre);
        $sql->bindValue(3,$apellidos);
        $sql->bindValue(4,$telefono);
        $sql->bindValue(5,$puesto);
        $sql->bindValue(6,$departamento);
        $sql->bindValue(7,$correo);
        $sql->bindValue(8,$idUsuario);
        $sql->bindValue(9,$idEmpleado);
        $sql->execute();
        return true;
    }
}
?>