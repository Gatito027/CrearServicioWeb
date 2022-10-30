<?php
class Conexion extends PDO{
    private $hostBd = 'localhost:3306';
    private $nombreBd = 'loginbd';
    private $usuarioBd = 'root';
    private $passwordBd = '';
    
    public function __construct()    {
        try{
            parent::__construct('mysql:host='. $this->hostBd . ";dbname=". 
            $this->nombreBd .";charset=utf8", $this->usuarioBd, $this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e){
            echo 'error'. $e->getMessage();
            exit;
        }
    }
}
?>