<?php

  $host = "localhost";
  $userName = "simo61151_wp1";
  $password = "EJCMv+k~[w(]";
  $database = "simo61151_minicms";

    $conn = new mysqli($host, $userName, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed:". $conn->connect_error);
    }

    // echo"Connected successfully";

?>