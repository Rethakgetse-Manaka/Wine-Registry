<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/compare.css">
    <link rel="stylesheet" href="css/homepage.css">
    
</head>
<?php 
    if(isset($_COOKIE['theme'])&& $_COOKIE['theme'] == 'light' && isset($_COOKIE['api_key'])){
        echo "<body class='light-theme'onload = applyTheme(\"".$_COOKIE['theme']."\")>";

      }else{
          echo "<body>";
      }
?>
    <!--Navbar-->
    <?php include('./globals/header.php')?>
    
     <div class="comparison">
        <div>
            <div class="filter-box">
                <div class="search_box">
                    <div class="Search">
                        <input type="text" id="input-box-1" placeholder="Search..." autocomplete="off">
                        <button  onclick="search()">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="result-box-1">
                        <ul id="display-box"></ul>
                    </div>
                </div>
            </div>
            <div class="cell-1">

            </div>
        </div>
        <div>
            <div class="filter-box">
                <div class="search_box">
                    <div class="Search">
                        <input type="text" id="input-box-2" placeholder="Search..." autocomplete="off">
                        <button onclick="searchCars2()">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="result-box-1">
                        <ul id="display-box-2"></ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="loading">
        <div class="loading-container"></div>
      </div>
    <script type="text/javascript" src="js/Compare.js" defer></script>  
</body>
<footer>
    <?php include("./globals/footer.php")?>
</footer>
</html>