<?php 
    session_start();
    
    //Singleton
    Class Brands_API{

        private $conn= null;

        public static function instance(){
            static $instance = null; 
            if($instance === null)
                $instance = new Brands_API();
            return $instance;
        }
        private function __construct(){
            $servername = "wheatley.cs.up.ac.za";
            $username = "u22491032";
            $password = "QQ6L47NA3ZLXLPQRPZL66AO35WETQI24";
            $db_name = "u22491032";
            // Create connection
            $this->conn = new mysqli($servername, $username,$password);
            // Check connection
            if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            }
            //Select database
            $db = $this->conn->select_db($db_name);
        }
        
        private function __destruct(){
            // close database connection
            $this->conn->close();
        }
        public function getBrands(){
            $sql = "SELECT * FROM Brands ORDER BY RAND() LIMIT 5";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $result = $statement->get_result();
            $brands = array();
            while($row = mysqli_fetch_assoc($result)) {
                $brands[] = $row;
            }
            return $brands;
        }

        function response($success, $message = "", $data="")
	    {
		    header("HTTP/1.1 200 OK");
		    header("Content-Type: application/json");
		
		    echo json_encode([
			    "success" => $success,
			    "message" => $message,
			    "data" => $data
		    ]);
	    }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $instance = Brands_API::instance();
        $brands = $instance->getBrands();
        $instance->response(true, "Cars successfully retrieved", $brands);
    }// Invalid request
    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header("HTTP/1.1 401 Unauthroized");
        header("Content-Type: application/json");
        echo json_encode([
            "success" => "false",
            "message" => "Invalid request method",
        ]); 
    }
    session_destroy();
    

?>