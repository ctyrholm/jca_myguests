<?php
    $servername = "localhost";
    $username = "ctyrholm";
    $password = "I2N1qlfUtljZ9ZUH";
    $dbname = "ctyrholm";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>