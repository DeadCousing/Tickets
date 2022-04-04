<?php

class Ticket extends Conectar {
    public function getTicket() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Ticket as t INNER join Empleado AS e ON (t.idEmpleado = e.idEmpleado) INNER JOIN Reporte AS r ON (t.idReporte = r.idReporte);";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findTicket($idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Ticket as t INNER join Empleado AS e ON (t.idEmpleado = e.idEmpleado) INNER JOIN Reporte AS r ON (t.idReporte = r.idReporte) where t.idTicket = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idTicket);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertTicket($idReporte, $idEmpleado, $descripcion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT Into Ticket(idReporte,idEmpleado,estatus,descripcion) VALUES (?,?,1,?);"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idReporte);
        $sql->bindValue(2,$idEmpleado);
        $sql->bindValue(3,$descripcion);
        $sql->execute();
        return true;
    }

    public function updateTicket($idTicket,$idReporte, $idEmpleado, $descripcion){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Ticket SET 
        idReporte=?,
        idEmpleado=?,
        descripcion=?
        WHERE idTicket=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$idReporte);
        $sql->bindValue(2,$idEmpleado);
        $sql->bindValue(3,$idEmpleado);
        $sql->bindValue(3,$idTicket);
        $sql->execute();
        return true; 
    }

    public function ticketAsignado($idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Ticket SET
        estatus = 2
        WHERE idTicket = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idTicket);
        $sql ->execute();
        return true;
    }

    public function ticketTerminado($idTicket){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE Ticket SET
        estatus = 0
        WHERE idTicket = ?;";
        $sql =$conectar->prepare($sql);
        $sql ->bindValue(1,$idTicket);
        $sql ->execute();
        return true;
    }

}

?>