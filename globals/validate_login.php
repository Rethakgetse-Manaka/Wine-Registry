<?php 
   session_start();
   
   class Login{
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
        $username = "u22491032";
        $password = "QQ6L47NA3ZLXLPQRPZL66AO35WETQI24";
        $db_name = "u22491032";
        $this->conn = mysqli_connect($servername, $username, $password, $db_name);
    }
    public function __destruct() {
        mysqli_close($this->conn);
    }
    public function response($success,$message="",$data=""){
        header("HTTP/1.1 200 OK");
		header("Content-Type: application/json");
		
		echo json_encode([
			"success" => $success,
            "timestamp" => time(),
			"message" => $message,
			"data" => $data
		]);
    }
    public function validateLogin($data){
        $email = $data->email;
        $password = $data->password;
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                $this->response(true,"Login successful",["user_id"=>$row['id'],"apikey"=>$row['api_key']]);
            }else{
                $this->response(false,"Incorrect password");
            }
        }else{
            $this->response(false,"User does not exist");
        }
    }
   }

   // Usage:
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $email = $data->email;
        $password = $data->password;
        $login = Login::getInstance();
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $login->response(false,"Invalid email");
            exit();
        }
        if(strlen($password) < 8){
            $login->response(false,"Password must be at least 8 characters long");
        }
        $login->validateLogin($data);
   }
   