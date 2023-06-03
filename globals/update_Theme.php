<?php 
    include('config.php');
   if(!$conn->connect_error){
      $conn->select_db("u22491032");
   }else{
      die("Connection failed: " . $conn->connect_error);
   }
   $email = $_COOKIE['email'];
   echo $email;
   echo $_COOKIE['light-theme-enabled'];
   if (isset($_COOKIE['light-theme-enabled'])) {
    $email = $_COOKIE['email'];
    if($_COOKIE['light-theme-enabled'] === 'true'){
        $theme = 'light';
    }else{
        $theme = 'dark';
    }
    echo $theme;
    $stmt = $conn->prepare('UPDATE users SET Theme = ? WHERE email = ?');
    $stmt->bind_param('ss', $theme, $email);
    $stmt->execute();
    if (isset($_COOKIE['theme'])) {
        setcookie('theme', '', time() - 3600, '/');
        unset($_COOKIE['theme']);
    }
    if($_COOKIE['light-theme-enabled'] === 'true'){
        setcookie('theme', 'light', time() + (86400 * 30), "/", "", false, true);
    }else{
        setcookie('theme', 'dark', time() + (86400 * 30), "/", "", false, true);
    }
    header("Location: ../Cars.php");
}
?>