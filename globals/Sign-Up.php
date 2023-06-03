<?php 
   session_start();
   
   class SignUp{
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
    public function SignUp($data){
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $data->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $this->response(false,"Email already exists");
            exit();
        }else{
            $random_bytes = random_bytes(16);
            $api_key = bin2hex($random_bytes);
            $theme = 'dark';
            $salt = base64_encode(random_bytes(mt_rand(11, 32)));
            $hash = password_hash($data->password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare('INSERT INTO users (name, surname, email, password,api_key,theme) VALUES (?, ?, ?, ?, ?,?)');
            $stmt->bind_param('ssssss', $data->name, $data->surname, $data->email, $hash,$api_key,$theme);
            $stmt->execute();
            $this->response(true,"Successfully Registered",$api_key);
        }
    }
   }

   // Usage:
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        $name = $data->name;
        $surname = $data->surname;
        $email = $data->email;
        $password = $data->password;
        $SignUp = SignUp::getInstance();
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $SignUp->response(false,"Invalid email");
            exit();
        }
        if(strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[@$!%*?&]/', $password)){
            $SignUp->response(false,"Password must be at least 8 characters long and contain uppercase and lowercase letters, a digit, and a symbol");
            exit();
        }
        $SignUp->SignUp($data);
   }
   