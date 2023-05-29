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
                <button id="Refine" class="refine" onclick="refine()">Refine</button>
                <?php
                if(isset($_COOKIE['api_key'])&& $_COOKIE['validated']){
                    echo "<button id='Refine' class='refine' onclick='checkFilters()'>Save preferences</button>";
                }
                ?>
             </div>
             
        </div>
        <!--Cars Section-->
        <div id="car-section"><!--Parent-->
          <div class="car-wrapper">
            
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