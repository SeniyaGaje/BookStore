const registerValidate = () => {
  const pass = document.getElementById("SignUp-pass").value;
  const confPass = document.getElementById("SignUp-Conpass").value;

  if (pass != confPass) {
    alert("Password Missmatch");
    return false;
  }

  // Check if reCAPTCHA is completed
  const captchaResponse = grecaptcha.getResponse();
  if (captchaResponse.length === 0) {
    alert("Please complete the CAPTCHA");
    return false;
  }

  return true;
};

// JavaScript for password validation and strength check
function checkPasswordStrength() {
  const password = document.getElementById("SignUp-pass").value;
  const strengthText = document.getElementById("passwordHelp");
  let strength = 0;

  // Check for minimum length first
  if (password.length < 8) {
      strengthText.style.color = "red";
      strengthText.textContent = "Error: Password must be at least 8 characters long.";
      return; // Exit the function early if the password is too short
  }

  // Additional regex validation for password complexity
  const regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

  // Check the regex for complexity
  if (!regexPattern.test(password)) {
      strengthText.style.color = "red";
      strengthText.textContent = "Error: Password must include uppercase, lowercase, digit, and special character.";
      return; // Exit if regex does not match
  }

  // Check for different criteria
  if (/[A-Z]/.test(password)) strength += 1; // At least one uppercase letter
  if (/[a-z]/.test(password)) strength += 1; // At least one lowercase letter
  if (/\d/.test(password)) strength += 1;    // At least one digit
  if (/[\W_]/.test(password)) strength += 1; // At least one special character

  // Display password strength based on the criteria count
  if (strength === 4) {
      strengthText.style.color = "green";
      strengthText.textContent = "Strong"; // All criteria met
  } else if (strength === 3) {
      strengthText.style.color = "orange";
      strengthText.textContent = "Medium"; // Three criteria met
  } else {
      strengthText.style.color = "red";
      strengthText.textContent = "Weak"; // Less than three criteria met
  }
}





function validateForm() {
   const password = document.getElementById("SignUp-pass").value;
   if (password.length < 8) {
       alert("Password must be 8 or more characters long."); // Alert if password is too short
       return false; // Prevent form submission
   }
   return true; // Allow form submission if valid
}


// JavaScript function to toggle password visibility for any input
function togglePassword(inputId, iconId) {
  const passwordField = document.getElementById(inputId);
  const toggleIcon = document.getElementById(iconId);

  // Check the type of the password field and toggle
  if (passwordField.type === "password") {
      passwordField.type = "text";  // Show password
      toggleIcon.classList.remove('ri-eye-line');  // Update the icon to hide symbol
      toggleIcon.classList.add('ri-eye-off-line'); // Add closed eye icon class
  } else {
      passwordField.type = "password"; // Hide password
      toggleIcon.classList.remove('ri-eye-off-line'); // Switch back to open eye icon
      toggleIcon.classList.add('ri-eye-line');
  }
}


function onSubmit(token) {
  if (token) {
     // reCAPTCHA was verified successfully
     const submitButton = document.getElementById("loginsubmit");
     submitButton.disabled = false;
     return true;
  } else {
     // reCAPTCHA verification failed, prevent form submission
     alert("Captcha failed");
     return false; // Explicitly return false to prevent form submission
  }
}


const logoutConfirmation = () => {
  const prp = confirm("Are you sure?");
  if (prp == true) return true;
  else return false;
};
