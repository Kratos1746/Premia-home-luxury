<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_premia";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>
