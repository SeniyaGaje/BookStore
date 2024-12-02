<?php
$server = "localhost";
// file deepcode ignore HardcodedCredential: <please specify a reason of ignoring this>
$username = "BookAdmin";
// file deepcode ignore HardcodedPassword: <please specify a reason of ignoring this>
$password = "Qfuag7el7lwSdITB";
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


