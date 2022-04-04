<?php

class Login extends Conectar{

    public function login($usuario,$contrasena){
        $conectar = parent::conexion();
        parent::set_names();
        $contra = sha1($contrasena);
        $sql = "SELECT * FROM Usuario where usuario = ? and contrasena = ?;";
        $sql = $conectar->prepare($sql);    
        $sql->bindValue(1,$usuario);
        $sql->bindValue(2,$contra);
        $sql->execute();

        if($sql){
            $res = sha1($usuario+""+$contrasena);
            $sql1 = "UPDATE Usuario SET
            token = ?
            where usuario = ? and contrasena = ?;";
            $sql1 = $conectar->prepare($sql);    
            $sql1->bindValue(1,$res);
            $sql1->bindValue(1,$usuario);
            $sql1->bindValue(1,$contrasena);
            $sql1->execute();

            return $res;
        }
    }

    public function logout($token) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Usuario where token = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$token);
        $sql->execute();
        
        if($sql){
            $sql1 = "UPDATE Usuario SET
            token = 'null'
            where token = ?";
            $sql1 = $conectar->prepare($sql);    
            $sql1->bindValue(1,$token);
            $sql->execute();

            return true;
        }else{
            return false;
        }
    }


    public function validarToken($token) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM Usuario where token = ?"; 
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$token);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>