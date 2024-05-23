<?php

class SQL extends PDO{

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp8", "root", "");
    }

    private function setParams($statement, $parameters = array()){
        
        foreach ($parameters as $key => $value) {
            
            $this->setParam($statement, $key, $value);

        }
    }

    private function setParam($statement, $key, $value){
        
        $statement->bindParam($key, $value);


    }

    public function executeQuery($rawQuery, $params = []){
     
        $stnt = $this->conn->prepare($rawQuery);

        $this->setParams($stnt, $params);

        $stnt->execute();

        return $stnt;

    }

    public function select($rawQuery, $params = array()):array{

        $stnt = $this->executeQuery($rawQuery, $params);

        return $stnt->fetchAll(PDO::FETCH_ASSOC);
        
    }
}