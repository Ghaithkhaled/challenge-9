<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "challenge 9";

// Maak verbinding met de database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controleer of de verbinding is gelukt
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}
?>