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
             <div class="filter-box">
               <select id="filter-select-sort"  class="filter-select">
                 <option value="" disabled selected>Sort</option>
                 <option value="Price(Highest - Lowest)" id="SortByModel">Sort by Prices(Highest - Lowest)</option>
                 <option value="Price(Lowest - Highest)" id="SortByBrand">Sort by Prices(Lowest - Highest)</option>
                 <option value="Wines(Newest)" id="SortByCarType">Sort by Wines(Newest)</option>
               </select>  
             </div>
             <div>
                <button id="Refine" class="refine" onclick="refine()">Refine</button><br>
                <button id="Refine" class="refine" onclick="refine()">Update Wines</button>
             </div>
             
        </div>
        <!--Cars Section-->
        <div id="car-section"><!--Parent-->
          <div class="car-wrapper">
            <div class="car">
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
            </div>
          </div>
          
        </div>
        <div class="loading">
          <div class="loading-container"></div>
        </div> 
        <script src ="js/Search_bar.js" ></script>
        <footer>
            <?php include("./globals/footer.php")?>
        </footer>
       </body>    
    </html>