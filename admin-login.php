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
    <title>Login</title>
</head>
<body>
    <!-- NavBar -->
    <?php include("globals/header.php")?>
    <div class="login-container">
        <form action="./globals/validate_login.php" class="login-form" method="POST">
            <div class = "heading">
                <h1>Login</h1>
            </div>
            <div class="flex-input">
                <input type="text" name="National_ID" id="National_ID" placeholder="ID Number" >
            </div>
            <div class="flex-input">
                <input type="text" name="Admin_ID" id="admin_ID" placeholder="ADMIN ID" >
            </div>
            <div class = "flex-input">
                <input type="password" name="Password" id="Password" placeholder="Password">
            </div>
            <div>
                <input type="submit" name="Submit" value="Login">
            </div> 
            <div class="Forgot-password">
                <a href="#">Forgot Password?</a>
            </div>      
        </form>
    </div>
    <footer>
            <?php include("./globals/footer.php")?>
    </footer>
</body>
    <style>
        .login-container {
            background-image: url("img/Login.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-color: grey;
            display: flex;
            justify-content: center;
            height: 700px;
            align-items: center;
        }
        .login-form{
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
        input[type="email"],[type="password"],[type="text"]{
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
        input[type="button"]:hover{
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
            input[type="email"],[type="password"],[type="submit"]{
                padding: 10px;
                font-size: 18px;
                width: 91%;
                border-radius: 5px; 
                border: none;
            }
        }
    </style>
</html>