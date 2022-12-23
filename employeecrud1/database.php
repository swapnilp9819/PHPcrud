<?php

class database{
    private $dbserver = "localhost";
    private $dbuser = "root";
    private $dbport = "3307";
    private $dbpassword = "Swapnilp@9819";
    private $dbname = "userdata";
    protected $conn;
    // check for port number as default is 3306, I already have a mysql installation therefore I had to configure my XAMP server's mysql on port 3307

    // constructor

    public function __construct(){

        try{
            $dsn="mysql:host={$this->dbserver};port={$this->dbport};dbname={$this->dbname};charset=utf8";
            $options = array(PDO::ATTR_PERSISTENT);
            $this->conn=new PDO($dsn, $this->dbuser, $this->dbpassword, $options);
        }
        catch(PDOException $e){
            echo "Connection error".$e->getMessage();
        }
        
    }
}



?>