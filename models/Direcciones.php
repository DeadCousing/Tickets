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

    public function insertDomicilios($descripcion,$calle,$numeroInt,$numeroExt,$colonia,$cp,$telExt,$correo,$ubicacionMaps,$cruces,$idCliente,$idContacto) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Direccion(descripcion,calle,numeroInt,numeroExt,colonia,cp,telExt,correo,ubicacionMaps,cruces,estatus,idCliente,idContacto) values(?,?,?,?,?,?,?,?,1,?,?);;"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$descripcion);
        $sql->bindValue(2,$calle);
        $sql->bindValue(3,$numeroInt);
        $sql->bindValue(4,$numeroExt);
        $sql->bindValue(5,$colonia);
        $sql->bindValue(6,$cp);
        $sql->bindValue(7,$telExt);
        $sql->bindValue(8,$correo);
        $sql->bindValue(9,$ubicacionMaps);
        $sql->bindValue(10,$cruces);
        $sql->bindValue(11,$idCliente);
        $sql->bindValue(12,$idContacto);
        $sql->execute();
        return true;
    }

    public function updateDomicilios($idDireccion,$descripcion,$calle,$numeroInt,$numeroExt,$colonia,$cp,$telExt,$correo,$ubicacionMaps,$cruces) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Direccion set
        descripcion = ?,
        calle = ?,
        numeroInt = ?,
        numeroExt = ?,
        colonia = ?,
        cp = ?,
        telExt= ?,
        correo = ?,
        ubicacionMaps = ?,
        cruces = ?
        where idDireccion = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$descripcion);
        $sql->bindValue(2,$calle);
        $sql->bindValue(3,$numeroInt);
        $sql->bindValue(4,$numeroExt);
        $sql->bindValue(5,$colonia);
        $sql->bindValue(6,$cp);
        $sql->bindValue(7,$telExt);
        $sql->bindValue(8,$correo);
        $sql->bindValue(9,$ubicacionMaps);
        $sql->bindValue(10,$cruces);
        $sql->bindValue(11,$idDireccion);
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