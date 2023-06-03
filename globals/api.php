<?php
    session_start();
    
    // error_reporting(0);

    //Singleton

   class CarsApi {
    private static $instance = null;
    public $conn;
    public $column_names;
    public static function getInstance() {
        if (self::$instance === null) {
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
    
    
    public function getImage($brand,$model){
        $response = "";
        // Set the URL for the API endpoint
        if(isset($brand)&&isset($model)){
            $url = "https://wheatley.cs.up.ac.za/api/getimage?brand=" . urlencode($brand);
            $url .="&model=".urlencode($model);
        }
        // Initialize cURL
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Send the HTTP request and get the response
        $response = curl_exec($ch);
        
        // Close the cURL resource
        curl_close($ch);
        return $response;
    }
    public function getAllCars($data) {
        // Check if the data is already cached
        
        if($data->return == "*"){
            $sql = "SELECT * FROM cars";
        }else{
            if(in_array("image",$data->return)){
                $columns = array_diff($data->return, array("image"));
                $sql = "SELECT " . implode(", ", $columns) . " FROM cars";
            }else{
                $sql = "SELECT " . implode(", ", $data->return) . " FROM cars";
            }
            
        }
            
            $where = array();
            if(isset($data->search)){
                $Search = ['make', 'model', 'body_type', 'engine_type', 'transmission'];
                $searchKeys = array_keys((array)$data->search);
                $diff = array_diff($searchKeys, $Search);
                if (!empty($diff)) {
                    header("HTTP/1.1 401");
                    header("Content-Type: application/json");
            
                    echo json_encode([
                        "success" => "Error",
                        "timestamp" => time(),
                        "message" => "Incorrect Search Parameters",
                        "data" => null
                    ]);
                    exit();
                }
            }
            
            if (isset($data->search->make)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $where[] = "make LIKE ?";
                }else{
                    $where[] = "make = ?";
                }
            }
            if (isset($data->search->model)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $where[] = "model LIKE ?";
                }else{
                    $where[] = "model = ?";
                }
            }
            
            if (isset($data->search->body_type)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $where[] = "body_type LIKE ?";
                }else{
                    $where[] = "body_type = ?";
                }
            }
            
            if (isset($data->search->engine_type)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $where[] = "engine_type LIKE ?";
                }else{
                    $where[] = "engine_type = ?";
                }
            }
            
            if (isset($data->search->transmission)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $where[] = "transmission LIKE ?";
                }else{
                    $where[] = "transmission = ?";
                }
            }
            if(isset($data->fuzzy)&&($data->fuzzy)){
                if (count($where) > 0) {
                    $sql .= " WHERE " . implode(" OR ", $where);
                }
            }else{
                if (count($where) > 0) {
                    $sql .= " WHERE " . implode(" AND ", $where);
                }
            }
            if(isset($data->sort)){
                $sql .= " ORDER BY " . $data->sort;  
            }
            if(isset($data->order)){
                $sql .= " ".$data->order;  
            }
            if(isset($data->limit)){
                $sql .= " LIMIT " . $data->limit;  
            }else{
                $sql .= " LIMIT 200 ";
            }

            $params = array();
            
            if (isset($data->search->make)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $params[] = $data->search->make."%";
                }else{
                    $params[] = $data->search->make; 
                }
            }
            if (isset($data->search->model)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $params[] = $data->search->model."%";
                }else{
                    $params[] = $data->search->model; 
                }
            }
            
            
            if (isset($data->search->body_type)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $params[] = $data->search->body_type."%";
                }else{
                    $params[] = $data->search->body_type; 
                }
            }
            
            if (isset($data->search->engine_type)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $params[] = $data->search->engine_type."%";
                }else{
                    $params[] = $data->search->engine_type; 
                }
            }
            
            if (isset($data->search->transmission)) {
                if(isset($data->fuzzy)&&($data->fuzzy)){
                    $params[] = $data->search->transmission."%";
                }else{
                    $params[] = $data->search->transmission; 
                }
            }
            try{
                $statement = $this->conn->prepare($sql);
            }catch(Exception $e){
                header("HTTP/1.1 401 Unauthorised");
		        header("Content-Type: application/json");
		
                echo json_encode([
                    "success" => "Error",
                    "timestamp" => time(),
                    "message" => "SQL Error check your SQL/Return parameters " .$e->getMessage()
                ]);
                exit();
            }   
            
            
        
            if (count($params) > 0) {
                $types = str_repeat("s", count($params));
                $statement->bind_param($types, ...$params);
            }
            // execute the statement
            $statement->execute();
            
            // get the results as a mysqli_result object
            $result = $statement->get_result();

            $car = array();
            while($row = mysqli_fetch_assoc($result)) {
                if (in_array('Transmission', $data->return) && count($data->return) === 1){
                    $car[] = $row;
                }else if(in_array('body_type', $data->return) && count($data->return) === 1){
                    $car[] = $row;
                }else{
                    $image = $this->getImage($row['make'],$row['model']);
                    $row['image'] = stripslashes($image);
                    $car[] = $row;
                }   
            }
        return $car;            
    }
    public function close(){
        $this->conn->close();
    }
    public function response($success, $message="",$data=""){
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

// Usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if (isset($data->apikey) && $data->apikey == "a9198b68355f78830054c31a39916b7f") {
        if (isset($data->type) && isset($data->return)) {
            
            try {
                $carsApi = CarsApi::getInstance();
                $cars = $carsApi->getAllCars($data);
                $carsApi->response("success", "Cars retrieved", $cars);
            } catch (Exception $e) {
                header("HTTP/1.1 401 Unauthorized");
		        header("Content-Type: application/json");
                echo json_encode([
                    "success" => "Error",
                    "timestamp" => time(),
                    "message" => $e->getMessage()
                ]);
            }
        }else{
            header("HTTP/1.1 401 Unauthorized");
		    header("Content-Type: application/json");
            echo json_encode([
                "success" => "Error",
                "timestamp" => time(),
                "message" => "Missing type/return Key"
            ]);
        }
    } else {
        header("HTTP/1.1 401 Unauthorized");
		header("Content-Type: application/json");
        echo json_encode([
            "success" => "Error",
            "timestamp" => time(),
            "message" => "Missing API Key"
        ]);
    }
}
session_destroy();
 
?>