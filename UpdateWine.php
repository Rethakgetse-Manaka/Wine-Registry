<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update a Winery</title>
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

    a.backBtn {
        text-align: center;
        display: inline-block;
        text-decoration: none;
        color: white;
        padding: 10px 14px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 30%;
        opacity: 0.9;
        font-family: "Body-Font";
        font-weight: 500;
        font-stretch: normal;
        font-size: 17px;
        background: #FACF39;
    }

    a.backBtn:hover {
        opacity: 1;
    }

    .backBtn {
        margin: auto;
        padding: 6px;
    }
    </style>
</head>
<body>
    <div class="mainContainer">
        <form onsubmit="InsertWinery(event)" id = "addWineForm" action="AddWine.php" method = "POST" style="border:1px solid #ccc">
        <div class="container">
            <p class = "heading" >Update a Winery</h1>
            <p>Please fill in the form below to update a winery.</p>
            <hr>
            <label for="wineryName">Winery ID:</label>
            <input type="text" id="wineryID" name="wineryID">
            <p class = 'demo' id = 'demo1'></p>

            <label for="productionSize">Production Size:</label>
            <input type="text" id="productionSize" name="productionSize">
            <p class = 'demo' id = 'demo2'></p>

            <label for="winemaker">Winemaker:</label>
            <input type="text" id="winemaker" name="winemaker">
            <p class = 'demo' id = 'demo4'></p>

            <label for="winemaker">Vineyard:</label>
            <input type="text" id="winemaker" name="vineyard">
            <p class = 'demo' id = 'demo5'></p>

            <br>
            <!-- <p class = 'demo' id = 'demo6'></p> -->
            <br>
            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick=clearAll()>Clear</button>
                <button id = "btnSignUp" type="submit" name="submit" class="signupbtn" onclick="return overallValidate()">Add Wine</button>
                <a class="backBtn" href="Wine_Destinations.php">Go Back</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>
<script src="js/updateWine.js" type = "text/javascript"></script>



