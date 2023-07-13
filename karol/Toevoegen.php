<?php
$server = "mariadb-test";
$user = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($server, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$voornaam = $_POST['voornaam'];
$tussenvoegsel = $_POST['tussenvoegsel'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$postcode = $_POST['postcode'];

$sql = "INSERT INTO gebruiker (voornaam, tussenvoegsel, achternaam, email, postcode) VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$email', '$postcode')";

if ($conn->query($sql) === TRUE) 
{
    echo "Gebruiker succesvol toegevoegd!";
}
else
{
    echo"Niet gelukt";
}
