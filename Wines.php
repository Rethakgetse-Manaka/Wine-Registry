<!DOCTYPE html>
    <html lang = "en">
       <head>
        <title>Wines - HomePage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href = "css/homepage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        
       </head>
        <body>
         <?php include('./globals/header.php')?>
        <!--Intro Section-->
        <div class="Intro">
            <div id="Intro-Heading" class="writing">
               <h1 class="writing">Where passion and wine come together for a symphony of notes</h1>
            </div>
            <img id="landing-image" src="img/launch-page.jpg" alt="picture of wines">
        </div>
        <!--Models-->
        <div class = "Models-Layout">
            <div>
               <div>
                  <h1>Our Wines</h1>
               </div>
               <div>
                  <p>Explore our wines list to  find the 
                     wine that suits you.</p>
               </div>
            </div>
         <!--Filter Section-->
             <div id="search filter" class="filter-box">
             <input id="search-input" type="text" placeholder="Enter wine name" />
             <button onclick="refine()" type="button">Search</button>
             </div>
             <div class="filter-box">
               <select id="filter-select-filter"  class="filter-select">
                  <option value="" disabled selected>Filter</option>
                  <option value="red">Red Wine</option>
                  <option value="white">White Wine</option>
                  <option value="rosé">Rosé Wine</option>
                  <option value="sparkling">Sparkling Wine</option>
                  <option value="dessert">Dessert wine</option>
                  <option value="fortified">Fortified Wine</option>
               </select>  
             </div>
             <div class="filter-box">
             <select id="filter-select-sort" class="filter-select">
               <option value="" disabled selected>Sort</option>
               <option value="Price(Highest - Lowest)" id="SortByModel">Sort by Prices(Highest - Lowest)</option>
               <option value="Price(Lowest - Highest)" id="SortByBrand">Sort by Prices(Lowest - Highest)</option>
               <option value="Alcohol Content(Highest - Lowest)" id="SortByCarType">Sort by Alcohol Content(Highest - Lowest)</option>
               <option value="Alcohol Content(Lowest - Highest)" id="SortByCarType">Sort by Alcohol Content(Lowest - Highest)</option>
            </select>
            

               <!-- <script>
               const selectElement = document.getElementById("filter-select-sort");
               selectElement.addEventListener("click", () => {
                  selectElement.options[0].disabled = true; // Disable the default option when clicked
               });
               </script> -->
             </div>
             <div>
                <button class="refine" onclick="PageLoad()">Reset Filters</button><br>
                <button id="Refine" class="refine" onclick="refine()">Refine</button><br>
                <button id="insertWine" class="refine" onclick="showForm()">Insert Wine</button>
                <br>
                <button id="updateWine" class="refine" onclick="updateWine()">Update Wine</button>
                 <br>
                 <button id="deleteWine" class="refine" onclick="deleteWine()">Delete Wine</button>
                <!-- <button id="Refine" class="refine" onclick="refine()">Update Wines</button> -->
             </div>
             
            <div id="formContainer" class="mainContainer">
             
             </div>
             <div id="buttonContainer" class="subContainer">

             </div>
        </div>
        <!--Cars Section-->
        <div id="car-section"><!--Parent-->
          <div class="car-wrapper">
            <!-- <div class="car">
               <img src="img/wine1.jpg" alt="wine1">
               <h2>JACOB'S CREEK</h2>
               <h3>SHIRAZ</h3>
               <li>Price: R189.99</li>
               <li>Bottle Size: 750ml</li>
               <li>pH: 3.6 </li>
               <li>Alcohol Content: 11%</li>
               <li>Region: Cape Town, South Africa</li>
            </div>

            <div class="car">
               <img src="img/wine2.jpg" alt="wine1">
               <h2>Bonterra</h2>
               <h3>ROSÉ</h3>
               <li>Price: R124.99</li>
               <li>Bottle Size: 750ml</li>
               <li>pH: 3.0 </li>
               <li>Alcohol Content: 10.4%</li>
               <li>Region: Milan, Italy</li>
            </div>

            <div class="car">
               <img src="img/wine3.jpg" alt="wine1">
               <h2>KLEINE ZALZE</h2>
               <h3>CARBANET SAUVIGNON</h3>
               <li>Price: R449.99</li>
               <li>Bottle Size: 750ml</li>
               <li>pH: 3.8 </li>
               <li>Alcohol Content: 11.8%</li>
               <li>Region: Stellenbosch, South Africa</li>
            </div> -->
          </div>
          
        </div>
        <div class="loading">
          <div class="loading-container"></div>
        </div> 
        <footer>
            <?php include("./globals/footer.php")?>
        </footer>
       </body>    
    </html>
