<?php
include "./shared/DBconnection.php";
session_start();

// Set default step
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

$step = $_SESSION['step'];  // Get the current step from session
$message = "";

if (isset($_POST['submit'])) {
    if ($step == 1 && isset($_POST['email'])) {
        $email = $_POST['email'];

        // Check if the email exists in the database
        $query = "SELECT * FROM users WHERE userEmail = '$email'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $verificationCode = rand(100000, 999999);  // Generate verification code
            $_SESSION['verificationCode'] = $verificationCode;
            $_SESSION['resetEmail'] = $email;

            // For demo purposes, display the code (replace with email logic)
            $message = "Verification code sent to your email: $verificationCode";
            $_SESSION['step'] = 2;  // Move to Step 2 (Verification Code)
        } else {
            $message = "Email not found!";
        }
    } elseif ($step == 2 && isset($_POST['code'])) {
        $enteredCode = $_POST['code'];
        if ($enteredCode == $_SESSION['verificationCode']) {
            // Verification successful, redirect to updatePassword.php
            header("Location: updatePassword.php");
            exit();
        } else {
            $message = "Invalid verification code!";
        }
    }

    // Update the step variable in the session after processing the form
    $step = $_SESSION['step'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Forgot Password</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap");

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 50px;
            font-family: "Montserrat", sans-serif;
            background-color: #f5f5f5;
        }

        #container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: hsl(230, 62%, 56%);
            margin-bottom: 1rem;
            font-size: 24px;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        input[type="email"], input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid hsl(230, 50%, 85%);
            background-color: hsl(230, 100%, 97%);
            font-size: 16px;
            margin-top: 10px;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: hsl(230, 62%, 56%);
            color: white;
            cursor: pointer;
            font-weight: 500;
            margin-top: 20px;
            width: 100px;
            margin-left: calc(50% - 50px);
        }

        button:hover {
            background-color: hsl(230, 62%, 50%);
        }

        .message {
            text-align: center;
            color: hsl(0, 100%, 40%);
            font-weight: 600;
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Forgot Password</h2>

    <form method="post">
        <?php if ($step == 1): ?>
            <!-- Step 1: Enter Email -->
            <div>
                <label for="email">Enter your Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

        <?php elseif ($step == 2): ?>
            <!-- Step 2: Enter Verification Code -->
            <div>
                <label for="code">Enter the Verification Code sent to your email:</label>
                <input type="text" name="code" id="code" required>
            </div>

        <?php endif; ?>

        <button type="submit" name="submit">Submit</button>

        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
