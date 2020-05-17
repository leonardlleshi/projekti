
<?php
/**
 * Created by PhpStorm.
 * User: Teas
 * Date: 5/5/2016
 * Time: 1:40 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

