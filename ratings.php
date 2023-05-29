<?php
  include ("./globals/config.php");
  if(!$conn->connect_error){
    $conn->select_db("u22491032");
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    $id_trim = $_POST['car_id'];
    $rating = $_POST['rating'];
    $api_key = $_COOKIE['api_key'];
    

    $sql = "INSERT INTO ratings (api_key, id_trim, rating)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE api_key = VALUES(api_key), id_trim = VALUES(id_trim), rating = VALUES(rating)";
                  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $api_key,$id_trim,$rating);
    $result = $stmt->execute(); 

    if ($result){
      header("Location: Cars.php");
      exit();
    }else{
      echo "Error: " . mysqli_error($conn);
      exit();
    }
  }
  // function get_average_rating($car_id) 
  // {
  //   include ("config.php");

  //   $query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE car_id = $car_id";
  //   $result = mysqli_query($conn, $query);

  //   if ($result) 
  //   {
  //     $row = mysqli_fetch_assoc($result);
  //     return round($row['avg_rating'], 1);
  //   } 
  //   else 
  //   {
  //     return 0;
  //   }
  // }
?>
