<?php

    if(!isset($_POST['submit'])){
        die("You can't directly access this file");
    }
    include "../shared/DBconnection.php";
    include "../shared/common.php";

    $name =htmlspecialchars($_POST["SignUp-Name"]);
    $email =htmlspecialchars($_POST["SignUp-email"]);
    $password =htmlspecialchars($_POST["SignUp-pass"]);

    try{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (userName, userEmail, userPass) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if($stmt->execute()){
            $_SESSION["logged"]=$email;
            header("Location: ../index.php");
        } else{
            $_SESSION["logged"]="";
            echo "Register Failed. <a href='../index.php'>Click</a> to redirect to homepage";
        }
    }
    catch(Exception $e){
        $_SESSION["logged"]="";
    }

    $stmt->close();
    $connection->close();
?>