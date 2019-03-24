<?php
    $sv_name = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'allpass';
    $conn = mysqli_connect($sv_name, $username, $password, $db_name);
    mysqli_query($conn, "SET NAMES 'utf8'");
    if(!$conn){
        $username = 'root';
        $password = 'BZ76agROZh';
        $conn = mysqli_connect($sv_name, $username, $password, $db_name);
        mysqli_query($conn, "SET NAMES 'utf8'");
        mysqli_query($conn, "SET time_zone = \"+8:00\"");
        if(!$conn){
            die('Connection failed.');
        }
    }
?>