<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="cinsystdatabase";

    $conn=mysqli_connect($servername,$username,$password,$database);

    if(mysqli_connect_errno()){
        echo "failed to connect";
        exit();
    }
