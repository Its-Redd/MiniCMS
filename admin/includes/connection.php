<?php

$host = "localhost";
$userName = "simo61151_wp1";
$password = "EJCMv+k~[w(]";
$database = "simo61151_minicms";

$conn = new mysqli($host, $userName, $password, $database);
if ($conn->connect_error) {
  die("Connection failed:" . $conn->connect_error);
}

// echo"Connected successfully";






/**
 * Finds a user in the database by their user ID.
 *
 * @param mysqli $conn The database connection object.
 * @param int $user_id The ID of the user to find.
 * @return object The result set object containing the user data.
 */
function FindUser($conn, $user_id): object
{
  $sql = "SELECT * FROM users WHERE Id = $user_id";


  return $result = $conn->query($sql);
}
