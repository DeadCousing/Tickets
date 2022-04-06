<?php

class Reporte extends Conectar {
    public function getReporte() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Reporte;";
        $sql = $conectar->prepare($sql);
        $sql ->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function finReporte($idReporte) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Reporte where idReporte = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idReporte);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertReporte($idDireccion,$idCliente,$fechaCreacion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO Reporte(idDireccion,idCliente,,fechaCreacion) VALUES (?,?,?,1);";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idDireccion);
        $sql ->bindValue(2,$idCliente);
        $sql ->bindValue(3,$fechaCreacion);
        $sql ->execute();
        return true;
    }

    public function updateReporte($idReporte,$idDireccion,$idCliente,$fechaCreacion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Reporte SET
        idDireccion = ?,
        idCliente = ?,
        fechaCreacion = ?
        WHERE idReporte = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idDireccion);
        $sql ->bindValue(2,$idCliente);
        $sql ->bindValue(3,$fechaCreacion);
        $sql ->bindValue(4,$idReporte);
        $sql ->execute();
        return true;
    }

    public function reporteAsignado ($idReporte){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Reporte SET
        estatus = 2
        WHERE idReporte = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idReporte);
        $sql ->execute();
        return true;
    }

    public function reporteTerminado ($idReporte){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Reporte SET
        estatus = 0
        WHERE idReporte = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idReporte);
        $sql ->execute();
        return true;
    }

}

?>