<?php 
    $email = "";
    $password_1 = "";
    $name = "";
    $Surname = "";
    // Checking if information has been posted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $name = $_POST['Name'];
        $Surname = $_POST['Surname'];
        $email = $_POST['Email'];
        $password_1 = $_POST['Password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // If the email address is invalid, notify the user
            echo "<script>alert('Invalid email address')</script>";
          } elseif (strlen($password_1) < 8 || !preg_match('/[A-Z]/', $password_1) || !preg_match('/[a-z]/', $password_1) || !preg_match('/\d/', $password_1) || !preg_match('/[@$!%*?&]/', $password_1)) {
            // If the password does not meet the requirements, notify the user
            echo "<script>alert('Password must be at least 8 characters long and contain uppercase and lowercase letters, a digit, and a symbol')</script>";
          }else{
            include('config.php');
            if(!$conn->connect_error){
                $conn->select_db("u22491032");
            }
          }
          // Check if the user already exists in the database
          $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
          $stmt->bind_param('s', $email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
              // If the user already exists, notify the user
              echo "<script>window.location='../signup.php';
                            alert('User already exists');
                    </script>";
          } else {
              // Insert the user into the database

              //Generate API Key
              // Generate a random string of 16 bytes
                $random_bytes = random_bytes(16);

                // Convert the random bytes to a hexadecimal string
                $api_key = bin2hex($random_bytes);
                $theme = 'dark';
                // Display the API key to the user
                $salt = base64_encode(random_bytes(mt_rand(11, 32)));
                $hash = password_hash($password_1, PASSWORD_BCRYPT);
                $stmt = $conn->prepare('INSERT INTO users (name, surname, email, password,api_key,theme) VALUES (?, ?, ?, ?, ?,?)');
                $stmt->bind_param('ssssss', $name, $Surname, $email, $hash,$api_key,$theme);
                $stmt->execute();
                // Notify the user that the registration was successful
                echo "<script>alert('Registration successful Your API key is: $api_key')</script>";
          }
          $conn->close();
          header("Location: ../Cars.php");
    }
    ?>
