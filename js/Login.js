function validateForm(){
    var emailInput = document.getElementById("Email");
    var passwordInput = document.getElementById("Password");

    // Validate email using regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // The regex above checks whether the emailInput has a @ and then followed by a domain which has . in it.
    if (!emailRegex.test(emailInput.value)) {
      alert("Please enter a valid email address.");
      return false;
    }
      return true;
}
