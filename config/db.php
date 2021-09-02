<?php
    $server = "localhost";
    $user= "root";
    $password = "root";
    $dbname = "phpblog";

    $connect = mysqli_connect($server, $user, $password, $dbname);

    if(!$connect){
        die("Connect Failed!".mysqli_connect_error());
    } else {
//        echo 'Connect Success!';
    }
?>
