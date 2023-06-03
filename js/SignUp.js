function validateForm() {
    var nameInput = document.getElementById("User");
    var SurnameInput = document.getElementById("Surname");
    var emailInput = document.getElementById("Email");
    var passwordInput = document.getElementById("Password");

    //Validate the name Input
    if (nameInput.value.length < 0) {
        alert("Please enter a name");
        return false;
    }

    //Validate the surname Input
    if (SurnameInput.value.length < 0) {
        alert("Please enter a Surname");
        return false;
    }

    // Validate email using regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // The regex above checks whether the emailInput has a @ and then followed by a domain which has . in it.
    if (!emailRegex.test(emailInput.value)) {
      alert("Please enter a valid email address.");
      return false;
    }

    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    // The regex used above uses positive lookahead assertion to check whether the password contains at
    // least one lowercase letter,one Capital letter,contains a digit,one special character.
    // [A-Za-z\d@$!%*?&]{8,}: Matches a string of at least 8 characters that contains only letters 
    // (both uppercase and lowercase), digits, and the special characters @$!%*?&.
      if (!passwordRegex.test(passwordInput.value)) {
        alert("Please enter a password that is at least 8 characters long, contains at least one upper and one lowercase letter, one digit and one special character.");
        return false;
      }

      return true;
    }