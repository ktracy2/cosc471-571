<?php
$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "3bdb";
// Create connection
//echo ($servername . " " . $username . " " . $password . " " . $dbname);
//phpinfo();
$conn = mysqli_connect($servername, $username, $password, $dbname);