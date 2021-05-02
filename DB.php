<?php

class DB {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'iprogrammer';
    private $conn;
    public function DBConnect(){
        try {
            $this->conn = new PDO("mysql:host=$this->servername; dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
    }

    public function DBClose(){
        $this->conn = null;
    }

    public function getStates() {
        $sql = "SELECT id, state_name FROM state";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCityByState($state_id = NULL)
    {
        $sql = "SELECT id, city_name FROM city WHERE state_id = ".$state_id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addFeedback($data = NULL)
    {
        $name = $data['name'];
        $state_id = $data['state_id'];
        $city_id = $data['city_id'];
        $feedback = $data['feedback'];

       $sql = "INSERT INTO feedback (`name`, `state_id`, `city_id`, `feedback`) VALUES('".$name."', '".$state_id."', '".$city_id."', '".$feedback."')";
       $this->conn->exec($sql);
       return; 
    }

}
?>