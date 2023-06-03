<?php
    class API_Wines{
        private static $instance = null;
        public $conn;
        public static function getInstance(){
            if(self::$instance === null){
                self::$instance = new self();
            }
            return self::$instance;
        } 
        private function __construct() {
            $servername = "wheatley.cs.up.ac.za";
            $username = "u22492616";
            $password = "SP2ZUCDHYQNAQQKYBZ4XIP7CFRWJEO33";
            $db_name = "u22492616_COS221";
            $this->conn = mysqli_connect($servername, $username, $password, $db_name);
        }
        public function __destruct() {
            mysqli_close($this->conn);
        }
        public function response($success,$message="",$data=""){
            if($success === false){
                header("HTTP/1.1 400 Error");
                header("Content-Type: application/json");
                echo json_encode([
                    "success" => $success,
                    "timestamp" => time(),
                    "message" => $message,
                    "data" => $data
                ]);
            }else{
                header("HTTP/1.1 200 OK");
                header("Content-Type: application/json");
            
                echo json_encode([
                    "success" => $success,
                    "timestamp" => time(),
                    "message" => $message,
                    "data" => $data
                ]);
            }
            
        } 
        //Get Wines function
        public function getWines($data) {
            //Searching of getWines
            $sql = "SELECT Wine.Name, Grape_Varietal.Name as Grape_Varietal, Wine.Price, Wine.Bottle_Size, Quality.pH, Quality.Alcohol_Content, Region.Location_Name, Region.Country, Wine.Image 
                    FROM Wine 
                    INNER JOIN Quality ON Wine.WineID = Quality.WineID 
                    INNER JOIN Winery ON Wine.WIneryID = Winery.WineryID 
                    INNER JOIN Grape_Varietal ON Wine.VarietalID = Grape_Varietal.Varietal_ID 
                    INNER JOIN Region ON Winery.RegionID = Region.RegionID ";
            if((isset($data->search))){
                $sql .= " Where Wine.Name LIKE '%" .$data->search->Name ."%'"; 
            }
           
            if((isset($data->sort))){
                $sql .= " Order by " .$data->sort ." ";
            }
            if((isset($data->order))){
                $sql .= $data->order;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(false,"No Wines found");
                exit();
            }
        }
        public function login($data){
            $stmt = $this->conn->prepare('SELECT * FROM User Where Email = ?');
            $stmt->bind_param('s', $data->username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"User logged In");
                exit();
            }else{
                $this->response(false,"User not found");
                exit();
            }
        } 
        public function getWineries($data){
            //Searching of getWines
            $sql = "";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Wines found",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(false,"No Wines found");
                exit();
            }
        }
        public function getRegions($data){
            $stmt = $this->conn->prepare('SELECT RegionName,Climate,Country,Image FROM Region');
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"Regions retrieved",$result->fetch_all(MYSQLI_ASSOC));
                exit();
            }else{
                $this->response(false,"Something went wrong");
                exit();
            }
        }
        public function Review($data){


        } 
        public function AdminLogin($data){
            $stmt = $this->conn->prepare('SELECT * FROM Admin_User Where AdminID = ? AND Password = ? AND Email = ?');
            $stmt->bind_param('sss', $data->adminID,$data->password,$data->username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $this->response(true,"User logged In");
                exit();
            }else{
                $this->response(false,"Please Enter correct user details");
                exit();
            }

        }     
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $API = API_Wines::getInstance();
        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->type) && isset($data->return)){
            switch($data->type){
                case "getWines":
                    $API->getWines($data);
                    break;
                case "login":
                    if(!isset($data->username) || !isset($data->password)){
                        $API->response(false,"Please fill in all details");
                        exit();
                    }
                    if(isset($data->adminID)){
                        $API->AdminLogin($data);
                    }else{
                        $API->login($data);
                    }
                    break;
                case "Review":
                    $API->Review($data);
                    break;
                case "getWinery":
                    $API->getWineries($data);
                    break;
                case "getRegions":
                    $API->getRegions($data);
                    break;
                default:
                    $API->response(false,"Invalid Action");
                    break;
            }
        }else{
            $API->response(false,"Missing Parameters");
        }
    }
?>