<?php
    class WineApi{
        private $connection = null;

        public static function instance(){
            static $instance = null;
            if($instance === null){
                $instance = new WineApi();      
            }
            return $instance;
        }

        private function __construct(){
            $host = "wheatley.cs.up.ac.za";
            $passwordP = "SP2ZUCDHYQNAQQKYBZ4XIP7CFRWJEO33";
            $username = "u22492616";
            $this->connection = new mysqli($host, $username, $passwordP);
            if($this->connection->connect_error){
               die("Connection failure: " . $this->connection->connect_error); 
            }else{
                $this->connection->select_db("u22492616_COS221");
            }
        }

        public function getWines(){
            $query = "SELECT Name, Price(ZAR), Bottle_Size(ml) FROM Wine";
            $statement = $this->connection->prepare($query);
            //$statement->bind_param("s", $apiK);
            $statement->execute();
            $result = $statement->get_result();
            $fData = $result->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            $response = array(
                "status" => "success",
                "timestamp" => time(),
                "data" => $fData
            );
            header('Content-type: application/json');
            $finalJson = json_encode($response);

            echo $finalJson;
        }

        public function getWineries(){
            $query = "SELECT Name, Production_Size, Vinyeard, Winemaker FROM Winery";
            $statement = $this->connection->prepare($query);
            //$statement->bind_param("s", $apiK);
            $statement->execute();
            $result = $statement->get_result();
            $fData = $result->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            $response = array(
                "status" => "success",
                "timestamp" => time(),
                "data" => $fData
            );
            header('Content-type: application/json');
            $finalJson = json_encode($response);

            echo $finalJson;
        }

        public function rate($api, $id, $rating, $comment){
            $query = "SELECT * FROM Reviews WHERE userID = ? AND WineID = ?";
            $statement = $this->connection->prepare($query);
            $statement->bind_param("si", $api, $id);
            $statement->execute();
            $result = $statement->get_result();
            $statement->close();
            if($result->num_rows > 0){
                $query1 = "UPDATE Reviews SET Rating = ? WHERE userID = ? AND WineID = ?";
                $statement1 = $this->connection->prepare($query1);
                $statement1->bind_param("isi",$rating, $api, $id);
                $statement1->execute();
                $statement1->close();
            }else{
                $query2 = "INSERT INTO Reviews(Comment, WineID, userID, Rating) VALUES(?,?,?,?)";
                $statement2 = $this->connection->prepare($query2);
                $statement2->bind_param("ssss", $comment, $api, $id, $rating);
                $statement2->execute();
                $statement2->close();
            }
        }

        public function validateLogin($username, $password){
            $query = "SELECT Name, Surname, API_key, Password FROM User WHERE Email=?";
            $statement = $this->connection->prepare($query);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();
            $fData = $result->fetch_all(MYSQLI_ASSOC);
            if($result->num_rows > 0){
                $prePassword = $password.$username.$fData[0]["Surname"].$fData[0]["Name"];
                $hashPassword = md5($prePassword);
                if($hashPassword === $fData[0]["Password"]){
                    $response = array(
                        "status" => "success",
                        "timestamp" => time(),
                        "data" => $fData
                    );
                    header('Content-type: application/json');
                    $finalJson = json_encode($response);
                    echo $finalJson;
                }
            }else{
                $response = array(
                    "status" =>"failed",
                    "timestamp" => time(),
                    "data" => []
                );
                header('Content-type: application/json');
                $finalJson = json_encode($response);
                echo $finalJson;
            }

            
        }

        public function apiError(){
            $obj = new stdClass();
            $obj->status = "error";
            $obj->timestamp = time();
            $obj->data = "Error. Post parameters are missing";
            header('Content-type: application/json');
            $objJSON = json_encode($obj);
            echo $objJSON;
        }

        public function apiInvalidError(){
            $obj = new stdClass();
            $obj->status = "error";
            $obj->timestamp = time();
            $obj->data = "Error. Post parameters are invalid/misspelt/missing";
            header('Content-type: application/json');
            $objJSON = json_encode($obj);
            echo $objJSON;
        }

        public function __destruct(){
            if($this->connection != null){
                $this->connection->close();
            }
            
        }
    }


    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $getType = "";
    $getTypeB = false;
    $instance = CarsApi::instance();

    if(array_key_exists('type', $data)){
        $getType = $data['type'];
        if($getType != "validateLogin" && $getType != "getAllWines" && $getType != "getAllWineries" && $getType != "review" && $getType != "signup"
        && $getType != "getFilter"){
            $getTypeB = false;
            $instance->apiInvalidError();    
            die();      
        }else{
            $getTypeB = true;
        }
        
    }else{
        $getTypeB = false;
        $instance->apiError();
        die();
    }
?>