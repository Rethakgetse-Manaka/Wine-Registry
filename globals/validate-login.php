<?php 
    $email = "";
    $password_1 = "";
    $validated = false;
    // Checking if information has been posted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $email = $_POST['Email'];
        $password_1 = $_POST['Password'];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // If the email address is invalid, notify the user
            echo "<script>alert('Invalid email address')</script>";
        } else {
            include('config.php');
            if(!$conn->connect_error){
                $conn->select_db("u22491032");
            }
            // Check if the user exists in the database
            $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 0) {
                // If the user does not exist, notify the user
                echo "<script>window.location='../login.php';
                                alert('User does not exist');
                        </script>";
            } else {
                // Verify the user's password
                $row = $result->fetch_assoc();
                if (password_verify($password_1, $row['password'])) {
                    // If the password is correct, create a session and log the user in
                    session_start();
                    setcookie('name', $row['name'], time() + 3600, '/');
                    setcookie('surname', $row['surname'], time() + 3600, '/');
                    setcookie('api_key', $row['api_key'], time() + 3600, '/');
                    setcookie('id', $row['id'], time() + 3600, '/');
                    setcookie('validated', true, time() + 3600, '/');
                    if($row['Theme'] == 'dark'){
                        setcookie('theme', 'dark', time() + (86400 * 30), "/", "", false, true);
                    }else{
                        setcookie('theme', 'light', time() + (86400 * 30), "/", "", false, true);
                    }
                    setcookie('email', $email, time() + (86400 * 30), "/", "", false, true);
                    header("Location: ../Cars.php");
                     
                } else {
                    // If the password is incorrect, notify the user
                    echo "<script>window.location='../login.php';
                                    alert('Incorrect password');
                            </script>";
                }
            }
            $conn->close();
        }
    
    }
?>
