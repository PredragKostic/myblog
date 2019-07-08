<?php
class Database{
    private $host = "localhost";
    private $user = "root";
    private $password ="";
    private $dbname = "myblog";

    private $dbh;
    private $error;
    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbname;
        //Set options
        $options = array (
            PDO::ATTR_PERSISTENT  => true,
            PDO::ATTR_ERRMODE     =>PDO::ERRMODE_EXCEPTION
        );
        //CREATTE NEW PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch(PDOExeption $e){
            $this->error = $e->getMessage();
        }
    }
}