<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "book_shop";

    try{
        $connection = mysqli_connect($server, $username, $password, $database);

        if(!$connection){
            die("Database Connection Error");
        }
    }
    catch(Exception $e){
        die("Database Connection Error: {$e->getMessage()}");
    }
?>