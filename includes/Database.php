<?php

class Database{
    /*private $dbHost = "studentmysql.miun.se";
    private $dbName = "asha1900";
    private $dbUser = "asha1900";
    private $dbPass = "bsan1x7m";
    public $conn;*/

    private $dbHost = "localhost";
    private $dbName = "test";
    private $dbUser = "admin";
    private $dbPass = "password";
    public $conn;


    // Funktion för att ansluta till databsen med ovanstående uppgifter
    public function connect(){
        $this->conn = null;
                try{
                    $this->conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
                    $this->conn->exec("set names utf8");
                }catch(PDOException $exception){
                    echo "Database could not be connected: " . $exception->getMessage();
                }
                return $this->conn;
    }
    // Funktion för att stänga anslutning till databas
    public function close(){
        $this->conn = null;
    }
}

?>