<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wine Destinations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/brand.css"/>
    <link rel="stylesheet" href="css/homepage.css"/>
    <style>
      #brand-section {
      background-color: #520101f6;
      padding: 50px;
      /* background-image: url("img/homepage.jpg"); */
      background-repeat:no-repeat;
      background-size: cover;
  }

  .text{
    margin-top: 20px;
    font-family: "Body-Font";
    font-weight:500;
    font-stretch: normal;
    font-size: 20px;
  }
  </style>
  <script src ="js/winery.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
    <!--Navbar-->
    <?php include('./globals/header.php')?>

    <!--Brands-->
    <div class = "Models-Layout">
      <div class="Intro">
            <div id="Intro-Heading" class="writing">
               <h1 class="writing">We collaborate with premier wineries across the globe</h1>
            </div>
            <!-- <img id="landing-image" src="img/Winery.jpg" alt="picture of wines"> -->
        </div>
      
               <select id="filter-select-sort"  class="refine">
                 <option value="default" disabled selected>Filter By</option>
                 <option value="Cabernet Sauvignon" id="SortByModel">Cabernet Sauvignon</option>
                 <option value="Chenin Blanc" id="SortByBrand">Chenin Blanc</option>
                 <option value="Chardonnay" id="SortByBrand">Chardonnay</option>
                 <option value="Cinsault" id="SortByBrand">Cinsault</option>
                 <option value="Gamay" id="SortByBrand">Gamay</option>
                 <option value="Gewürztraminer" id="SortByBrand">Gewürztraminer</option>
                 <option value="Grenache" id="SortByBrand">Grenache</option>
                 <option value="Icewine" id="SortByBrand">Icewine</option>
                 <option value="Malbec" id="SortByBrand">Malbec</option>
                 <option value="Mourvèdre" id="SortByBrand">Mourvèdre</option>
                 <option value="Muscat" id="SortByBrand">Muscat</option>
                 <option value="Nebbiolo" id="SortByBrand">Nebbiolo</option>
                 <option value="Pedro Ximénez" id="SortByBrand">Pedro Ximénez</option>
                 <option value="Pinot Grigio" id="SortByBrand">Pinot Grigio</option>
                 <option value="Pinot Meunier" id="SortByBrand">Pinot Meunier</option>
                 <option value="Pinot Noir" id="SortByBrand">Pinot Noir</option>
                 <option value="Provence" id="SortByBrand">Provence</option>
                 <option value="Riesling" id="SortByBrand">Riesling</option>
                 <option value="Sangiovese" id="SortByBrand">Sangiovese</option>
                 <option value="Sauternes" id="SortByBrand">Sauternes</option>
                 <option value="Sauvignon Blanc" id="SortByBrand">Sauvignon Blanc</option>
                 <option value="Shiraz" id="SortByBrand">Shiraz</option>
                 <option value="Tokaji" id="SortByBrand">Tokaji</option>
                 <option value="Viognier" id="SortByBrand">Viognier</option>
                 <option value="Zinfandel" id="SortByBrand">Zinfandel</option>
               </select>  
        </div>
        <div class="filter-box">
          <button id="Refine" class="refine" onclick="PageLoad()">Reset</button>
        </div>
        <div class="filter-box">
          <button id="Refine" class="refine" onclick="window.location.href = 'updateWine.php'">Update a Winery</button>
        </div>
        <div class="filter-box">
        <button id="Refine" class="refine" onclick="window.location.href = 'addWine.php'">Add a Winery</button>
        </div>
        <div class="filter-box">
        <button id="Refine" class="refine" onclick="window.location.href = 'DeleteWinery.php'">Delete a Winery</button>
        </div>  
        
      </div>
    </div>    
    <section id="brand-section">
     <div class="brand-wrapper">
      <!-- <div class="brand">
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
      </div> -->
      </div>
   </section>
   <div class="loading">
          <div class="loading-container"></div>
        </div> 
        <script src ="js/Search_bar.js" ></script>
   <footer>
      <?php include("./globals/footer.php")?>
   </footer>
</body>
</html>
