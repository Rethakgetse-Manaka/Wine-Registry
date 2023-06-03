<?php include("./globals/config.php")?>
<?php include("validate-login.php")?>

<!--Navbar-->
<script src="js/main.js" defer></script>
<script src="js/preferences.js" defer></script>
<script src="js/Search_bar.js" defer></script>
<nav>
            <ul class="nav-links">
               <li><a id=Cars-link href="Wines.php" onclick="PageLoad();toggleActive()">Wines</a></li>
               <li><a id=Brands-link href="Wine_Destinations.php" onclick="toggleActive()">Wineries</a></li>
               <li><a id=Find-link href="Region.php" onclick="toggleActive()">Regions</a></li>
               <?php
               if(isset($_COOKIE['validated'])&& $_COOKIE['validated']){
                  $id = $_COOKIE['api_key'];
                  $name = $_COOKIE['name'];
                  echo "<li><a href=''>User Name: ".$name."</a></li>";
                  echo "<li><a href='./globals/logout.php'id=LogOut'>Logout</a></li>";
               }else{
                     echo '<li><a href="./login.php">User-Login</a></li>';
                     echo '<li><a href="./admin-login.php">Admin-Login</a></li>';
                     echo '<li><a href="./signup.php">Sign-Up</a></li>';
               }
               
                ?>
               
            </ul>
</nav>
