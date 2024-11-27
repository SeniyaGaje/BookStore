<?php
include "./shared/DBconnection.php";  // Ensure you are including the correct path to your DB connection
session_start();

$message = "";

// Check if reset email exists in session
if (!isset($_SESSION['resetEmail'])) {
    // If the session doesn't contain the email, redirect to forgot password page
    header("Location: forgotPassword.php");
    exit();
}

if (isset($_POST['submit'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if new password and confirm password match
    if ($newPassword === $confirmPassword) {
        $email = $_SESSION['resetEmail'];

        // Hash the new password before saving to the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Use the correct column name for password in your database
        $query = "UPDATE users SET userPass = '$hashedPassword' WHERE userEmail = '$email'";  // Adjust 'userPassword' to match your column name
        if ($connection->query($query)) {
            $message = "Password successfully updated!";
            // Clear the session after password update
            session_destroy();
            // Redirect to index.php after the password update
            header("Location: index.php");
            exit();
        } else {
            $message = "Error updating password!";
        }
    } else {
        $message = "Passwords do not match!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Update Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 50px;
            font-family: "Montserrat", sans-serif;
            background-color: #f5f5f5;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid hsl(230, 50%, 85%);
            background-color: hsl(230, 100%, 97%);
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: hsl(230, 62%, 56%);
            color: white;
            cursor: pointer;
            font-weight: 500;
        }
        button:hover {
            background-color: hsl(230, 62%, 50%);
        }
        .message {
            text-align: center;
            color: hsl(0, 100%, 40%);
            font-weight: 600;
        }
        .strength {
            margin-top: 10px;
        }
        .strength span {
            display: block;
            height: 10px;
            background-color: lightgray;
            border-radius: 5px;
        }
        .strength.weak span {
            background-color: red;
        }
        .strength.medium span {
            background-color: orange;
        }
        .strength.strong span {
            background-color: green;
        }
    </style>
</head>
<body>

<form method="post" onsubmit="return validatePassword()">
    <h2>Update Password</h2>

    <div>
        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" id="newPassword" required oninput="checkPasswordStrength()">
        <div class="strength" id="passwordStrength">
            <span></span>
        </div>
    </div>

    <div>
        <label for="confirmPassword">Confirm New Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required>
    </div>

    <div>
        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> Show Password
    </div>

    <button type="submit" name="submit">Submit</button>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
</form>

<script>
    function togglePasswordVisibility() {
        const newPassword = document.getElementById("newPassword");
        const confirmPassword = document.getElementById("confirmPassword");
        const showPassword = document.getElementById("showPassword");

        if (showPassword.checked) {
            newPassword.type = "text";
            confirmPassword.type = "text";
        } else {
            newPassword.type = "password";
            confirmPassword.type = "password";
        }
    }

    function checkPasswordStrength() {
        const password = document.getElementById("newPassword").value;
        const strengthIndicator = document.getElementById("passwordStrength");

        let strength = 0;

        // Check the strength of the password
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[\W]/.test(password)) strength++;

        // Set strength class and indicator based on conditions
        if (strength === 0) {
            strengthIndicator.className = "strength";
        } else if (strength === 1) {
            strengthIndicator.className = "strength weak";
        } else if (strength === 2) {
            strengthIndicator.className = "strength medium";
        } else {
            strengthIndicator.className = "strength strong";
        }
    }

    function validatePassword() {
        const newPassword = document.getElementById("newPassword").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }
</script>

</body>
</html>
