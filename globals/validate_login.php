<?php 
    
    // Checking if information has been posted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $National_ID = $_POST["National_ID"];
        $admin_ID = $_POST['Admin_ID'];
        $password_1 = $_POST['Password'];

        $validInput = false;
        if(strlen($National_ID) == 0)
        {
            echo "<script type='text/javascript'>window.location='../admin-login.php';alert('You did not enter your ID Number');</script>";
        }
        else if(strlen($admin_ID) == 0){
            echo "<script type='text/javascript'>window.location='../admin-login.php';alert('You did not enter your admin ID');</script>";
        }
        else if(strpos($admin_ID, " ") > -1){
            echo "<script type='text/javascript'>window.location='../admin-login.php';alert('Spaces are not allowed in admin ID');</script>";
        } 
        else if(strlen($password_1) == 0){
            echo "<script type='text/javascript'>window.location='../admin-login.php';alert('You did not enter your password');</script>";
        }
        else if(strpos($password_1, " ") > -1){
            echo "<script type='text/javascript'>window.location='../admin-login.php';alert('Spaces are not allowed in your password');</script>";
        }
        else {
            include('config.php');
            if(!$conn->connect_error){
                $conn->select_db("u22492616_COS221");
            }
            // Check if the user exists in the database
            $stmt = $conn->prepare('SELECT * FROM Admin_User WHERE AdminID = ?');
            $stmt->bind_param('s', $admin_ID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                // If the user does not exist, notify the user
                echo "<script>window.location='../admin-login.php';
                                alert('User does not exist');
                        </script>";
            } else {  
                $row = $result->fetch_assoc();

                $pass = $row["Password"];
                 $hash = hash('sha256',$password_1);
                if($hash == $pass)
                {
                    echo "<script>alert('You successfully logged in');</script>";
                    $_SESSION["AdminID"] = $admin_ID;
                    echo "<meta http-equiv='refresh' content='0; url=../Wines.php'>"; 
                    
                }
                else
                {
                    echo "<script>window.location='../admin-login.php';
                            alert('Incorrect Password');
                    </script>"; 
                }
                
                
            }
            $conn->close();
        }
    
    }
?>
