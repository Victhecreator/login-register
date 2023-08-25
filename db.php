

<?php
$serverName = "localhost";
$dbUser = "root";
$dbpassword = "qwertyuiop";
$dbName = "login_register";
// $conn = mysqli_connect($serverName, $dbUser, $password, $dbName);
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $dbUser, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?>
