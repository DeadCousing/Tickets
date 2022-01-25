<?php

class Domicilios extends Conectar {

    public function getDomicilios() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Direccion;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getallDOmiciliosCliente() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Direccion as d inner join Contacto as co on (d.idContacto = co.idContactos) inner join Cliente as cli on (d.idCLiente = cli.idClientes) where d.estatus = 1;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertDomicilios($descripcion,$domicilio,$colonia,$cp,$telExt,$correo,$ubicacionMaps,$cruces,$idCliente,$idContacto) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Direccion(descripcion,domicilio,colonia,cp,telExt,correo,ubicacionMaps,cruces,estatus,idCliente,idContacto) values(?,?,?,?,?,?,?,?,1,?,?);;"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$descripcion);
        $sql->bindValue(2,$domicilio);
        $sql->bindValue(3,$colonia);
        $sql->bindValue(4,$cp);
        $sql->bindValue(5,$telExt);
        $sql->bindValue(6,$correo);
        $sql->bindValue(7,$ubicacionMaps);
        $sql->bindValue(8,$cruces);
        $sql->bindValue(9,$idCliente);
        $sql->bindValue(10,$idContacto);
        $sql->execute();
        return true;
    }

    public function updateDomicilios($idDireccion,$descripcion,$domicilio,$colonia,$cp,$telExt,$correo,$ubicacionMaps,$cruces) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Direccion set
        descripcion = ?,
        domicilio = ?,
        colonia = ?,
        cp = ?,
        telExt= ?,
        correo = ?,
        ubicacionMaps = ?,
        cruces = ?
        where idDireccion = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$descripcion);
        $sql->bindValue(2,$domicilio);
        $sql->bindValue(3,$colonia);
        $sql->bindValue(4,$cp);
        $sql->bindValue(5,$telExt);
        $sql->bindValue(6,$correo);
        $sql->bindValue(7,$ubicacionMaps);
        $sql->bindValue(8,$cruces);
        $sql->bindValue(9,$idDireccion);
        $sql->execute();
        return true;
    }
    
    public function deactivateDomicilio($idDireccion) {
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "UPDATE Domicilio set estatus = 0 where idDireccion = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idDireccion);
        $sql->execute();
        return true;
    }
    
    public function activateDomicilio($idDireccion) {
        $conectar= parent::conexion();
        parent::set_names();
        $sql = "UPDATE Domicilio set estatus = 1 where idDireccion = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idDireccion);
        $sql->execute();
        return true;
    }

    public function findDomicilio($idDomicilio) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Direccion where idDireccion = '$idDireccion';";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>