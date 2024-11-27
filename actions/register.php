<?php

    if(!isset($_POST['submit'])){
        die("You can't directly access this file");
    }
    include "../shared/DBconnection.php";
    include "../shared/common.php";

    $name = $_POST["SignUp-Name"];
    $email = $_POST["SignUp-email"];
    $password = $_POST["SignUp-pass"];

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
        echo "<h1>Something went wrong.</h1>Error: {$e->getMessage()}<br /> <br /><a href='../index.php'>Click</a> to redirect to homepage";
    }

    $stmt->close();
    $connection->close();
?>