<?php
include "./shared/DBconnection.php"; // Ensure correct path to your DB connection
session_start();

$message = "";

// Check if reset email exists in session
if (!isset($_SESSION['resetEmail'])) {
    // Redirect to forgot password page if email is missing
    header("Location: forgotPassword.php");
    exit();
}

if (isset($_POST['submit'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate that passwords match
    if ($newPassword === $confirmPassword) {
        // Validate password strength (example: at least 8 characters, one special character)
        if (strlen($newPassword) >= 8 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $newPassword)) {
            $email = $_SESSION['resetEmail'];

            // Hash the new password before saving
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Prepare query to update the password
            $query = "UPDATE users SET userPass = ? WHERE userEmail = ?";

            // Initialize prepared statement
            if ($stmt = $connection->prepare($query)) {
                // Bind parameters to the query
                $stmt->bind_param("ss", $hashedPassword, $email);

                // Execute the query
                if ($stmt->execute()) {
                    $message = "Password successfully updated!";
                    session_destroy(); // Clear session
                    header("Location: index.php"); // Redirect to login
                    exit();
                } else {
                    $message = "Error updating password: {$stmt->error}";
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                $message = "Error preparing query.";
            }
        } else {
            $message = "Password must be at least 8 characters long and contain both letters and numbers.";
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
            margin: 0;
            font-family: "Montserrat", sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 350px;
            width: 100%;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
        }

        input[type="password"] {
            width: 100%;
            padding: 8px;
            font-size: 0.9rem;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #666;
        }

        .message {
            margin-top: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Password</h2>
        <form method="post" onsubmit="return validatePassword()">
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" name="newPassword" id="newPassword" required oninput="checkPasswordStrength()">
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm New Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
            </div>

            <div class="form-check">
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                <label for="showPassword" class="form-check-label">Show Password</label>
            </div>

            <button type="submit" name="submit">Submit</button>

            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>

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
