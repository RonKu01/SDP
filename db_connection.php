 <?php
 
$DB_SERVER = 'localhost:3306';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'sdp';
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
// Check connection
if(mysqli_connect_error()){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>