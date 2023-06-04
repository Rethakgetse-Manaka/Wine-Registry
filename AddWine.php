<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<script>
        function goBack() {
            window.location.href = 'Wine_Destinations.php';
    }
</script>
    <title>Add a Winery</title>
    <style>
    .mainContainer {
    margin: auto;
    width: 70%;
    padding: 10px;
    background-color: rgb(235, 234, 234);
    }

    body {
    background-color:#560606f6;
    }
    * {box-sizing: border-box}

    label{
    margin-top: 20px;
    font-family: "Body-Font";
    font-weight:500;
    font-stretch: normal;
    font-size: 17px;
    }
    
        .heading{
        text-align: center;
        font-size:30px;
        font-family: "Body-Font";
        font-weight:700;
        font-stretch: normal;
        color: #550a0a;
        }
        .container {
        padding: 50px;
        }
        button {
            background-color: #15ac75;
            color: white;
            padding: 10px 14px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 90%;
            opacity: 0.9;
            font-family: "Body-Font";
            font-weight:500;
            font-stretch: normal;
            font-size: 17px;
        }
        
        button:hover {
            opacity:1;
        }

        .cancelbtn {
            padding: 10px 14px;
            background-color: #eb2222;
        }
        .backBtn{
            width: 30%;
            margin: auto;

            padding: 6px;
            font-size: 17px;
            background: #FACF39;
        }
        .backBtn :hover{
            opacity:1;
        }
        
    .cancelbtn, .signupbtn {
        float: left;
        width: 50%;
    }
    @media screen and (max-width: 300px) {
        .cancelbtn, .signupbtn {
        width: 100%;
        }
    }
        input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin-top: 5px;
        margin-bottom: 5px;
        display: inline-block;
        border: none;
        background: #ddd;
        /*border: 2px solid red;*/
        border-radius: 4px;
    }
    
    input[type=text]:focus, input[type=password]:focus {
        background-color: #908181;
        outline: none;
    }
    .demo{
    font-size: 17px;
    font-family: "Body-Font";
    font-stretch: normal;
    }
    hr {
        border: 1px solid #550a0a;
        margin-bottom: 25px;
    }
    .varietal-column {
        display: inline-block;
        vertical-align: top;
        width: 30%;
        font-size: xx-small;
    }
    .region-column {
        display: inline-block;
        vertical-align: top;
        width: 30%;
        font-size: xx-small;
    }
    </style>
</head>
<body>
    <div class="mainContainer">
        <form id = "addWineForm" action="AddWine.html" method = "POST" style="border:1px solid #ccc">
        <div class="container">
            <p class = "heading" >Add a Winery</h1>
            <p>Please fill in the form below to add a winery.</p>
            <hr>
            <label for="wineryName">Winery Name:</label>
            <input type="text" id="wineryName" name="wineryName">
            <p class = 'demo' id = 'demo1'></p>

            <label for="productionSize">Production Size:</label>
            <input type="text" id="productionSize" name="productionSize">
            <p class = 'demo' id = 'demo2'></p>

            <label for="vineyard">Vineyard:</label>
            <input type="text" id="vineyard" name="vineyard">
            <p class = 'demo' id = 'demo3'></p>

            <label for="winemaker">Winemaker:</label>
            <input type="text" id="winemaker" name="winemaker">
            <p class = 'demo' id = 'demo4'></p>

            <label>Grape Varietal:</label><br><br>
            <div class="varietal-column">
                <input type="radio" id="varietal1" name="varietal" value="Cabernet Sauvignon">
                <label for="varietal1">Cabernet Sauvi'</label><br>

                <input type="radio" id="varietal4" name="varietal" value="Cinsault">
                <label for="varietal4">Cinsault</label><br>

                <input type="radio" id="varietal7" name="varietal" value="Grenache">
                <label for="varietal7">Grenache</label><br>

                <input type="radio" id="varietal10" name="varietal" value="Mourvèdre">
                <label for="varietal10">Mourvèdre</label><br>

                <input type="radio" id="varietal13" name="varietal" value="Pedro Ximénez">
                <label for="varietal13">Pedro Ximénez</label><br>

                <input type="radio" id="varietal16" name="varietal" value="Pinot Noir">
                <label for="varietal16">Pinot Noir</label><br>

                <input type="radio" id="varietal19" name="varietal" value="Sangiovese">
                <label for="varietal19">Sangiovese</label><br>

                <input type="radio" id="varietal22" name="varietal" value="Shiraz">
                <label for="varietal22">Shiraz</label><br>

                <input type="radio" id="varietal25" name="varietal" value="Zinfandel">
                <label for="varietal25">Zinfandel</label><br>
                
            </div>

            <div class="varietal-column">
                <input type="radio" id="varietal2" name="varietal" value="Chenin Blanc">
                <label for="varietal2">Chenin Blanc</label><br>

                <input type="radio" id="varietal5" name="varietal" value="Gamay">
                <label for="varietal5">Gamay</label><br>

                <input type="radio" id="varietal8" name="varietal" value="Icewine">
                <label for="varietal8">Icewine</label><br>

                <input type="radio" id="varietal11" name="varietal" value="Muscat">
                <label for="varietal11">Muscat</label><br>

                <input type="radio" id="varietal14" name="varietal" value="Pinot Grigio">
                <label for="varietal14">Pinot Grigio</label><br>

                <input type="radio" id="varietal16" name="varietal" value="Pinot Noir">
                <label for="varietal16">Pinot Noir</label><br>

                <input type="radio" id="varietal17" name="varietal" value="Provence">
                <label for="varietal17">Provence</label><br>

                <input type="radio" id="varietal20" name="varietal" value="Sauternes">
                <label for="varietal20">Sauternes</label><br>

                <input type="radio" id="varietal23" name="varietal" value="Tokaji">
                <label for="varietal23">Tokaji</label><br>
            </div>

            <div class="varietal-column">
                <input type="radio" id="varietal3" name="varietal" value="Chardonnay">
                <label for="varietal3">Chardonnay</label><br>

                <input type="radio" id="varietal6" name="varietal" value="Gewürztraminer">
                <label for="varietal6">Gewürztraminer</label><br>

                <input type="radio" id="varietal9" name="varietal" value="Malbec">
                <label for="varietal9">Malbec</label><br>

                <input type="radio" id="varietal12" name="varietal" value="Nebbiolo">
                <label for="varietal12">Nebbiolo</label><br>

                <input type="radio" id="varietal15" name="varietal" value="Pinot Meunier">
                <label for="varietal15">Pinot Meunier</label><br>

                <input type="radio" id="varietal18" name="varietal" value="Riesling">
                <label for="varietal18">Riesling</label><br>

                <input type="radio" id="varietal21" name="varietal" value="Sauvignon Blanc">
                <label for="varietal21">Sauvi' Blanc</label><br>

                <input type="radio" id="varietal24" name="varietal" value="Viognier">
                <label for="varietal24">Viognier</label><br>
            </div>

            <br>
            <p class = 'demo' id = 'demo5'></p>
            <br>

            <label>Region Name:</label><br><br>
            <div class="region-column">
                <input type="radio" id="region2" name="region" value="Agrelo">
                <label for="region2">Agrelo</label><br>

                <input type="radio" id="region13" name="region" value="California">
                <label for="region13">California</label><br>

                <input type="radio" id="region1" name="region" value="Empordà">
                <label for="region1">Empordà</label><br>

                <input type="radio" id="region11" name="region" value="Oakville">
                <label for="region11">Oakville</label><br>    

                <input type="radio" id="region6" name="region" value="Rutherford">
                <label for="region6">Rutherford</label><br>     
      
            </div>

            <div class="region-column">
                <input type="radio" id="region3" name="region" value="Alentejo">
                <label for="region3">Alentejo</label><br>

                <input type="radio" id="region10" name="region" value="Chambertin Grand Cru">
                <label for="region10">Chambertin Cru</label><br>

                <input type="radio" id="region4" name="region" value="Moon Mountain District">
                <label for="region4">Moon Mountain</label><br>

                <input type="radio" id="region7" name="region" value="Ribera del Duero">
                <label for="region7">Ribera Duero</label><br>
                <input type="radio" id="region9" name="region" value="Western Cape">
                <label for="region9">Western Cape</label><br> 
            </div>

            <div class="region-column">
                <input type="radio" id="region5" name="region" value="Amarone della Valpolicella">
                <label for="region5">Amarone della</label><br>

                <input type="radio" id="region8" name="region" value="Côte-Rôtie">
                <label for="region8">Côte-Rôtie</label><br>

                <input type="radio" id="region12" name="region" value="Napa Valley">
                <label for="region12">Napa Valley</label><br>

                <input type="radio" id="region14" name="region" value="Veneto">
                <label for="region14">Veneto</label><br>
            </div>
            <br>
            <p class = 'demo' id = 'demo6'></p>
            <br>
            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="return clearAll()">Clear</button>
                <button id = "btnSignUp" type="submit" name="submit" class="signupbtn" onclick="return overallValidate()">Add Wine</button>   <!-- //on click, it will add to database -->
                <button class="backBtn" onclick="window.location.href = 'Wine_Destinations.php';">Go Back</button>
            </div>
        </div>
        </form>
    </div>
</body>
</html>
<script src="js/AddWine.js" type = "text/javascript"></script>



