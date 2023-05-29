<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href = "css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/SignUp.js"></script>
    <title>Login</title>
</head>
<body>
    <!-- NavBar -->
    <?php include("globals/header.php")?>
    <div class="signUp-container">
        <form method="POST" action="./globals/validate-signup.php" class="signUp-form" >
            <div class = "heading">
                <h1>Sign Up</h1>
            </div>
            <div class="flex-input">
                <input type="text" name="Name" id="User" placeholder="Name">
            </div>
            <div class="flex-input">
                <input type="text" name="Surname" id="Surname" placeholder="Surname">
            </div>
            <div class="flex-input">
                <input type="email" name="Email" id="Email" placeholder="Email">
            </div>
            <div class = "flex-input">
                <input type="password" name="Password" id="Password" placeholder="Password">
            </div>
            <div>
                <input type="submit" name="" value="Submit" onclick="return validateForm()">
            </div> 
                  
        </form>
    </div>
    <footer>
            <?php include("./globals/footer.php")?>
    </footer>
</body>
    <style>
        .signUp-container {
            background-image: url("img/Sign_Up.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-color: grey;
            display: flex;
            justify-content: center;
            height: 700px;
            align-items: center;
        }
        .signUp-form{
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
            width: 400px;
            border-radius: 5px;
        }
        .heading h1{
            display: flex;
            justify-content: center;
            color: black;
            font-weight:bold;
        }
        .flex-input{
            display: flex;
            flex-direction: row;
            margin-bottom: 10px;
            justify-content: center;
        }
        input[type="text"],[type="password"],input[type="email"]{
           padding: 10px;
           font-size: 18px;
           width: 100%;
           border-radius: 5px; 
           border: none;
        }
        input[type="submit"]{
            width: 100%;
            font-size: 20px;
            padding: 10px;
            background-color: black;
            color: white;
            border-radius: 5px;
            border: none;
            margin: 20px 0px;
        }
        input[type="submit"]:hover{
            background-color: rgb(104, 106, 108);
            color: black;
            cursor: pointer;
        }
        .Forgot-password a{
            text-decoration: none;
            color: black;
            font-weight:bold;
        }
        .Forgot-password a:hover{
            text-decoration: underline;
        }
        
        @media (max-width: 480px){
            .flex-input{
                display: flex;
                flex-direction: column;
            }
            input[type="text"],[type="password"],[type="email"]{
                padding: 10px;
                font-size: 18px;
                width: 91%;
                border-radius: 5px; 
                border: none;
            }
        }
    </style>
</html>