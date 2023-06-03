<?php 
    $email = "";
    $password_1 = "";
    $name = "";
    $Surname = "";
    $age = "";
    $nID = "";

    // Checking if information has been posted
        // Retrieve the form data
        $name = $_POST['Name'];
        $Surname = $_POST['Surname'];
        $email = $_POST['Email'];
        $password_1 = $_POST['Password'];
        $age = intval($_POST["Age"]);
        $nID = $_POST["nID"];
        
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // If the email address is invalid, notify the user
            echo "<script>alert('Invalid email address')</script>";
          } elseif (strlen($password_1) < 8 || !preg_match('/[A-Z]/', $password_1) || !preg_match('/[a-z]/', $password_1) || !preg_match('/\d/', $password_1) || !preg_match('/[@$!%*?&]/', $password_1)) {
            // If the password does not meet the requirements, notify the user
            echo "<script>alert('Password must be at least 8 characters long and contain uppercase and lowercase letters, a digit, and a symbol')</script>";
          }else{
            include('globals/config.php');
            if(!$conn->connect_error){
                $conn->select_db("u22492616_COS221");
            }
          }

          // Check if the user already exists in the database
          $statement = $conn->prepare("SELECT * FROM User WHERE Email=?");
          $statement->bind_param("s", $email);
          $statement->execute();
          $result = $statement->get_result();
          $statement->close();

          if ($result->num_rows > 0) {
              // If the user already exists, notify the user
              echo "<script>window.location='../signup.php';
                            alert('User already exists');
                    </script>";
          } else {
              // Insert the user into the database
                // Display the API key to the user
                $userPrefix = 'UR';
                $userID =  uniqid($userPrefix);
                $hash = password_hash($password_1, PASSWORD_BCRYPT);
                $statement = $conn->prepare("INSERT INTO User(UserID, Name, Surname, Email, Age, National_ID, Password) VALUES(?,?,?,?,?,?,?)");
                $statement->bind_param("ssssiss", $userID, $name, $Surname, $email, $age, $nID, $hash);
                $statement->execute();
                $statement->close();
                // Notify the user that the registration was successful
                echo "<script>alert('Registration successful, please go login.')</script>";
                header("Location: login.php");
          }
          $conn->close();
          
    
    ?>
