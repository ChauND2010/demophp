<?php
    
    $conn=mysqli_init(); 
    
    $servername = "demomyphp.mysql.database.azure.com";
    $username = "nguyendongchau@demomyphp";
    $password = "Dongchau199@";
    $dbname = "demophp";
    $conn=mysqli_init();
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306);
    //mysqli_set_charset($conn, 'UTF8');
   

    if (mysqli_connect_errno())
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    //$conn = new mysqli($servername, $username, $password);
    //if ($conn->connect_error) {
    //    die("Connection failed: " . $conn->connect_error);
    //}

    //$conn->select_db($dbname);

    return $conn;
?>
