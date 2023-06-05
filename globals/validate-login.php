<?php 
    
    // Checking if information has been posted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $National_ID = $_POST["National_ID"];
        $email = $_POST['Email'];
        $password_1 = $_POST['Password'];

        $validInput = false;
        if(strlen($National_ID) == 0)
        {
            echo "<script type='text/javascript'>window.location='../login.php';alert('You did not enter your National ID');</script>";
        }
        else if(strlen($email) == 0){
            echo "<script type='text/javascript'>window.location='../login.php';alert('You did not enter your email');</script>";
        }
        else if(strpos($email, " ") > -1){
            echo "<script type='text/javascript'>window.location='../login.php';alert('Spaces are not allowed in your email');</script>";
        } 
        else if(strpos($email, '@') === false){
            echo "<script type='text/javascript'>window.location='../login.php';alert('You need a @ in your email');</script>";
        }
        else if(strlen($password_1) == 0){
            echo "<script type='text/javascript'>window.location='../login.php';alert('You did not enter your password');</script>";
        }
        else if(strpos($password_1, " ") > -1){
            echo "<script type='text/javascript'>window.location='../login.php';alert('Spaces are not allowed in your password');</script>";
        }
        else {
            include('config.php');
            if(!$conn->connect_error){
                $conn->select_db("u22492616_COS221");
            }
            // Check if the user exists in the database
            $stmt = $conn->prepare('SELECT * FROM User WHERE Email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                // If the user does not exist, notify the user
                echo "<script>window.location='../login.php';
                                alert('User does not exist');
                        </script>";
            } else {
                $row = $result->fetch_assoc();

                $pass = $row["Password"];
                 $hash = hash('sha256',$password_1);
                if($hash == $pass)
                {
                    echo "<script>alert('You successfully logged in');</script>";
                    $_SESSION["Email"] = $email;
                    echo "<meta http-equiv='refresh' content='0; url=../Wines.php'>"; 
                    
                }
                else
                {
                    echo "<script>window.location='../login.php';
                            alert('Incorrect Password');
                    </script>"; 
                }
                
            }
            $conn->close();
        }
    
    }
?>