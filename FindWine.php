<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindCar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/FindCar.css">
    <style>
        .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        max-width: 100%;
        padding: 28px;
        background-image: url("img/Find_Car.jpg");
        background-color: rgba(0, 0, 0, 0.5);
        background-blend-mode: multiply;
        background-size: cover;
    }
    </style>
    <script src = "js/Find_Me_A_Car.js" ></script>
    <script src = "js/main.js"></script> 
</head>

<body onload="populateTransmission(),populateCarType(),populateBrand()">
    <div class="loading">
        <div class="loading-container"></div>
    </div>
    <!--Navbar-->
    <?php include('./globals/header.php')?>
    
    <!--Form-->
    <div class="form-container">
        <form action="#">
            <h1 class="form-title">Find Car</h1>
            <div class="user-spec">
                <div class="user-input-box">
                    <div>
                        <div class="year">
                            <select id="filter-select-Brand"  class="filter-select">
                                <option value="" disabled selected>Brand</option>
                            </select>
                        </div>
                    <div>
                        <div class="year">
                            <select id="filter-select-TT"  class="filter-select" required>
                                <option value="" disabled selected>Transmission Type</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="year">
                            <select id="filter-select-car-type"  class="filter-select" required>
                                <option value="" disabled selected>Body Type</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="year">
                            <form>
                                <input type="radio" name="fuel" value="Petrol" required>
                                <label for="yes">Petrol</label>
                                <input type="radio" name="fuel" value="Diesel" required>
                                <label for="no">Diesel</label>
                            </form>
                        </div>
                    </div>    
                    </div>
                <div class="form-submit-btn">
                    <input type="submit" value="Find Car" id="Find_Car" onclick="">
                </div>    
                </div>
            </div>
        </form>
    </div>
    <section id="car-section">
        <div class="car-wrapper">
        </div>
    </section>
    <footer>
        <?php include("./globals/footer.php")?>
    </footer>
</body>
</html>