 <?php
   include "../shared/DBconnection.php";
    include "../shared/common.php";
    

    if($_SESSION['logged']==""){
        die("You have to login to delete your account");
    }
    $sql = "DELETE FROM users WHERE userEmail = '{$_SESSION["logged"]}';";

    if ($connection->query($sql) === TRUE) {
        include "./logout.php";
        echo "<h1>Account Deleted Successfully.</h1> <a href='../index.php'>Click</a> to redirect to homepage";
    } else {
        echo "<h1>Error deleting account.</h1>Error: {$connection->error}<br /> <br /><a href='../index.php'>Click</a> to redirect to homepage";
    }

?> 