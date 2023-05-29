<?php 
   // destroy the session
   if(isset($_COOKIE['validated'])){
      setcookie('validated', '', time() - 3600, '/');
      unset($_COOKIE['validated']); 
   }
   if(isset($_COOKIE['surname'])){
      setcookie('surname', '', time() - 3600, '/');
      unset($_COOKIE['surname']); 
   }
   if(isset($_COOKIE['name'])){
      setcookie('name', '', time() - 3600, '/');
      unset($_COOKIE['name']); 
   }
   if(isset($_COOKIE['id'])){
      setcookie('id', '', time() - 3600, '/');
      unset($_COOKIE['id']); 
   }
   if(isset($_COOKIE['light-theme-enabled'])){
      setcookie('light-theme-enabled', '', time() - 3600, '/');
      unset($_COOKIE['light-theme-enabled']); 
   }
   if(isset($_COOKIE['api_key'])){
      setcookie('api_key', '', time() - 3600, '/');
      unset($_COOKIE['api_key']); 
   }
   if (isset($_COOKIE['theme'])) {
      setcookie('theme', '', time() - 3600, '/');
      unset($_COOKIE['theme']);
   }
   if (isset($_COOKIE['email'])) {
      setcookie('email', '', time() - 3600, '/');
      unset($_COOKIE['email']);
   }
   session_unset();
   session_destroy();
   // redirect to another page
   header("Location: ../Cars.php");
   exit; 
?>