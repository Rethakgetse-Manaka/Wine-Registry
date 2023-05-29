<?php
    //Start session
    session_start();
    $api_key = $_COOKIE['api_key'];
    class preferencesAPI{
        private static $instance = null;
        public $conn;
        public static function getInstance(){
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
        private function __construct(){
            $servername = "wheatley.cs.up.ac.za";
            $username = "u22491032";
            $password = "QQ6L47NA3ZLXLPQRPZL66AO35WETQI24";
            $db_name = "u22491032";
            $this->conn = mysqli_connect($servername, $username, $password, $db_name); 
        }
        public function __destruct(){
            $this->conn->close();
        }
        public function updateUserPreferences($data){
                $api_key = $_COOKIE['api_key'];
                $sql = "INSERT INTO User_Preferences (api_key, Body_Type, Transmission_Type, Sort)
                        VALUES (?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE api_key = VALUES(api_key), Body_Type = VALUES(Body_Type), Transmission_Type = VALUES(Transmission_Type), Sort = VALUES(Sort)";
                  
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('ssss', $api_key,$data->preferences[0],$data->preferences[1],$data->preferences[2]);
                $stmt->execute();            
        }
        
        public function getUserPreferences(){
            $api_key = $_COOKIE['api_key'];
            try{
                $stmt = $this->conn->prepare('SELECT * FROM User_Preferences WHERE api_key = ?');
                $stmt->bind_param('s', $api_key);
                $stmt->execute();
            }catch(Exception $e){
                $this->response("Failure","APIkey non exisistent");
                exit();
            }
            $result = $stmt->get_result();
            $preferences = array();
            while($row = mysqli_fetch_assoc($result)){
                $preferences[] = $row;
            }
            return $preferences;
        }
        public function response($success, $message="",$data=""){
            if($success == "Failure"){
                header("HTTP/1.1 401 Bad Request");
                header("Content-Type: application/json");
            }else{
                header("HTTP/1.1 200 OK");
                header("Content-Type: application/json");
            }
            
            echo json_encode([
                "success" => $success,
                "timestamp" => time(),
                "message" => $message,
                "data" => $data
            ]);
        }
    }


    //Retreive user filter preferences

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $preferences = preferencesAPI::getInstance();
        if(isset($data->type) && $data->type == "GetUserPreference"){
            try{
                $preferences->response("Success","Preferences retreived",$preferences->getUserPreferences());
            }catch(Exception $e){
                $preferences->response("Failure","Preferences not retreived");
            }
        }else if(isset($data->type) && $data->type == "PostUserPreference"){
            try{
                $preferences->updateUserPreferences($data);
                $preferences->response("Success","Preferences Updated");
            }catch(Exception $e){
                $preferences->response("Failure","Preferences not updated");
            }
        }else{
            $preferences->response("Failure","Preferences not updated");
        }
    }















?>