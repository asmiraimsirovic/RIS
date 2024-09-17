<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pilot";
$conn = new mysqli($servername, "root", "", $dbname,);
if ($conn->connect_error) {
    die("Konekcija nije uspješna: " . $conn->connect_error);
}
?>