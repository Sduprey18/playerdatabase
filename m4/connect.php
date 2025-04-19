<?php
/*()
// Database credentials
$servername = "betaweb.csug.rochester.edu"; // usually "localhost" or the IP address of your MySQL server
$username = "sduprey2"; // Your MySQL username
$password = "apP=syZ4"; // Your MySQL password
$dbname = "sduprey2_1"; // The name of your database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Exit if the connection fails
}

echo "Connected successfully";

// Close the connection
$conn->close();
*/

$host = "localhost"; 
$username = "sduprey2"; 
$password = "apP=syZ4"; 
$database = "sduprey2_1";   

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

#echo("new output statement")

?>
