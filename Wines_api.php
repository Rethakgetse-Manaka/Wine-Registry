
<?php
    ini_set('display_errors', '1');
    header('Content-Type: application/json');
    require_once('config.php');
    $API = WineAPI::instance();
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($data["type"])){
            
            echo json_encode($API->failMessage("Type parameter not set")); 
            return;
        }
        
        if($data["type"] == "GetAllWines")
        {
            
            $apikey = $data["apikey"];
            $db = Database::instance();
            $wines = $db->getWines();
            echo json_encode(["status"=> "success", "timestamp"=>time(), "data"=>$wines]);

            
        }
        else if($data["type"] == "Sort")
        {
            
            if(!array_key_exists("sort_by", $data)){
                echo json_encode($API->failMessage("No sort value provided"));
                return;
            }
            $sort_by = $data["sort_by"];
            
            
            $db = Database::instance();
            $sortedWines = $db->sortedWines($sort_by);
            echo json_encode(["status"=> "success", "timestamp"=>time(), "data"=>$sortedWines]);

            
        }
        else if($data["type"] == "rate")
        {
            

            if(!array_key_exists("wineID", $data)){
                echo json_encode($API->failMessage("No wineID provided"));
                return;
            }
            if(!array_key_exists("userID", $data)){
                echo json_encode($API->failMessage("No userID provided"));
                return;
            }
            if(!array_key_exists("rating", $data)){
                echo json_encode($API->failMessage("No rating provided"));
                return;
            }
            $wineID = $data["wineID"];
            $rating_value = $data["rating"];
            $userID = $data["UserID"];
            $comment = $data["comment"];
            $db = Database::instance();
            $db->addRating($userID, $wineID,$rating_value,$comment);
        }
    
    }
  
   
    class WineAPI
    {
        public function __construct(){
            //
        }
        public function __destruct(){
            //
        }
        public function failMessage($message){
            return ["status"=> "failed", "timestamp"=>time(), "data"=>["message"=>$message]];
        }

        public static function instance(){
            static $instance = null;

            if($instance === null){
                $instance = new WineAPI();
            }

            return $instance;
        }
           
    }    
    
?>



