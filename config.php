<?php
    session_start(); // session start

    
    class Database{
        
        public $connection;
        private $host = 'wheatley.cs.up.ac.za';
        private $username = 'u22492616';
        private $password = "SP2ZUCDHYQNAQQKYBZ4XIP7CFRWJEO33";


        public static function instance(){
            static $instance = null;
            if($instance === null){
                $instance = new Database();
            }

            return $instance;
        }

        public function __construct(){
            $this->connection = new MySqli($this->host, $this->username, $this->password);
            
            if($this->connection->connect_error){
                die("connection failure: " . $this->connection->connect_error);
            }
            else{
                $this->connection->select_db("u22492616_COS221");
                
            }
        }

        public function __destruct(){
            //disconnect from the database
            $this->connection->close();
        }
        
        public function addUser($userID,$name, $email, $Age, $National_ID){
            //insert the new User into the User table

            //security: to guard against SQL-injection
            $statement = $this->connection->prepare("INSERT INTO User(userID,Name,Email,Age,National_ID) VALUES (?, ?, ?, ?, ?)");
            $statement->bind_param('sssss', $u, $n, $e, $a,$ni);
            
            
            $n = $name;
            
            $e = $email;
            $u = $userID;
            
            $a = $Age;
            $ni = $National_ID;
            $statement->execute();
        }
        public function UserExists($email){
            $statement = $this->connection->prepare("SELECT * FROM User WHERE Email = ?");
            $statement->bind_param('s', $e);
            
            $e = $email;        
            $statement->execute();

            $result = $statement->get_result();

            if($row = $result->fetch_array(MYSQLI_ASSOC)){
                return true;
            }
            else{
                return false;
            }
        }

        

        public function ratingExists($userID,$wineID){
            $statement = $this->connection->prepare("SELECT * FROM Reviews WHERE userID = ? AND wineID = ?");
            $statement->bind_param('ss', $u,$w);
            
            $u = $userID;
            $w = $wineID;        
            $statement->execute();

            $result = $statement->get_result();

            if($row = $result->fetch_array(MYSQLI_ASSOC)){
                return true;
            }
            else{
                return false;
            }
        }
        public function addRating($userID, $wineID, $rating_value,$comment){
            if($this->ratingExists($userID,$wineID) == true || $this->ratingExists($userID,$wineID) == 1)
            {
                $statement = $this->connection->prepare("UPDATE Reviews SET Rating = ?,Comment = ? WHERE userID = ? AND wineID = ? ");
                $statement->bind_param('isss', $r,$c,$u,$w);
                $r = $rating_value;
                $u = $userID;
                $w = $wineID;
                $c = $comment;
                $statement->execute();
            }
            else{
                $statement = $this->connection->prepare("INSERT INTO Reviews(userID,wineID,Rating,Comment) VALUES (?, ?, ?, ?)");
                $statement->bind_param('ssis', $u, $w, $r, $c);
                $r = $rating_value;
                $u = $userID;
                $w = $wineID;
                $c = $comment;
                $statement->execute();
            }
        }
        
    }
    public function getWines()
    {
        $statement = $this->connection->prepare("SELECT Wine.Name,Wine.Price(ZAR),Wine.Bottle_Size(ml),Quality.Alcohol_Content(%),Quality.Density(g/ml),Quality.pH FROM Wine JOIN Quality ON Wine.WineID = Quality.WineID");
            
            
            $statement->execute();
            $result = $statement->get_result();
            $wines = array();

            while ($row = $result->fetch_assoc()) {
                $wines[] = $row;
            }
            return $wines;
    }

    public function sortedWines($sort_by)
    {
        $statement = $this->connection->prepare("SELECT Wine.Name,Wine.Price(ZAR),Wine.Bottle_Size(ml),Quality.Alcohol_Content(%),Quality.Density(g/ml),Quality.pH FROM Wine JOIN Quality ON Wine.WineID = Quality.WineID  ORDER BY  ?");
        $statement->bind_param('s', $s);
        $s = $sort_by;
            
        $statement->execute();
        $result = $statement->get_result();
        $wines = array();

        while ($row = $result->fetch_assoc()) {
            $wines[] = $row;
        }
        return $wines;

    }
    

?>