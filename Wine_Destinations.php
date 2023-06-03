<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/brand.css"/>
    <link rel="stylesheet" href="css/homepage.css"/>
    <style>
      #brand-section {
      background-color: #520101f6;
      padding: 50px;
      background-image: url("img/homepage.jpg");
      background-repeat:no-repeat;
      background-size: cover;
  }
  </style>
  <script src ="js/Brands.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<?php 
        // if(isset($_COOKIE['theme'])&& $_COOKIE['theme'] == 'light' && isset($_COOKIE['api_key'])){
        //   echo "<body class='light-theme' onload='BrandsLoad();applyTheme(\"".$_COOKIE['theme']."\")'>";

        // }else{
        //     echo "<body onload='BrandsLoad()'>";
        // }
       ?>
    <!--Navbar-->
    <?php include('./globals/header.php')?>

    <!--Brands-->
    <div class = "Models-Layout">
      <div class="Intro">
            <div id="Intro-Heading" class="writing">
               <h1 class="writing">We deal with the finest wineries around the world.</h1>
            </div>
            <img id="landing-image" src="img/Winery.jpg" alt="picture of wines">
        </div>
        <div class="filter-box">
               <select id="filter-select-sort"  class="filter-select">
                 <option value="" disabled selected>Sort</option>
                 <option value="Price(Highest - Lowest)" id="SortByModel">Sort By Country (A-Z)</option>
                 <option value="Price(Lowest - Highest)" id="SortByBrand">Sort By Country (Z-A)</option>
                 <option value="Price(Lowest - Highest)" id="SortByBrand">Sort By Production Size (Asc)</option>
                 <option value="Price(Lowest - Highest)" id="SortByBrand">Sort By Production Size (Desc)</option>
               </select>  
        </div>
        <div>
          <button id="Refine" class="refine" onclick="refine()">Refine</button><br>
          <button id="Refine" class="refine" onclick="refine()">Update Wineries</button>
        </div>
      </div>
    <div class="loading">
      <div class="loading-container"></div>
    </div>    
    <section id="brand-section">
     <div class="brand-wrapper">
      <div class="brand">
        <img src="img/Winery1.jpg" alt="Winery">
        <h3>Lavaux vineyards, Switzerland</h3>
        <li>Winemaker: Liam King</li>
        <li>Production Size: 3367</li>
        <li>Grape Varetal: Malbec</li>
        <a href="#" style="text-decoration: underline;">Learn more about grape varietal?</a>
        <a href="#" style="text-decoration: underline;">Visit Website</a>
      </div>
      <div class="brand">
        <img src="img/Winery2.jpg" alt="Winery">
        <h3>Chateau Montelena, California</h3>
        <li>Winemaker: Mia Anderson</li>
        <li>Production Size: 1456</li>
        <li>Grape Varetal: Chenin Blanc</li>
        <a href="#" style="text-decoration: underline;">Learn more about grape varietal?</a>
        <a href="#" style="text-decoration: underline;">Visit Website</a>
      </div>
      <div class="brand">
        <img src="img/Winery3.jpg" alt="Winery">
        <h3>Bodega Garzon, Uruguay</h3>
        <li>Winemaker: Olivia Harris</li>
        <li>Production Size: 678</li>
        <li>Grape Varetal: Sangiovese</li>
        <a href="#" style="text-decoration: underline;">Learn more about grape varietal?</a>
        <a href="#" style="text-decoration: underline;">Visit Website</a>
      </div>
      </div>
   </section>
   <footer>
      <?php include("./globals/footer.php")?>
   </footer>
</body>
</html>