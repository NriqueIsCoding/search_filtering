<?php

class DB {
    private $con;
    private $host = "localhost"; 
    private $dbname = "search_filtering"; 
    private $user = "root";
    private $password = "N3tw0rk83";

    public function __construct() {
       $dsn = "mysql:host=" . $this->host . ";dbname=" .  $this->dbname;

       try {
           $this->con = new PDO($dsn, $this->user, $this->password);
           $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e) {
           echo "Connection Failed: " . $e->getMessage();
       }
    }

    public function viewData() {
        $query = "SELECT `name` FROM `names`";

        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function searchName($name) {
        $query = "SELECT `name` FROM `names` WHERE `name` LIKE :name";
        $stmt = $this->con->prepare($query);
        $stmt->execute(["name" => "%" . $name . "%"]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }   
}