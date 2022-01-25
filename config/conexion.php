<?php
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            $hostname = 'mysql:dbname=tickets;host=127.0.0.1:3303;';
            $usuario = 'root';
            $contrasena = 'root12';
            try {
				$conectar = $this->dbh = new PDO($hostname, $usuario, $contrasena);
				return $conectar;	
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();	
			}
        }

        public function set_names(){	
			return $this->dbh->query("SET NAMES 'utf8'");
        }
    }
?>