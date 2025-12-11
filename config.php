<?php
// config.php - database connection
$host = "localhost";
$user = "root";
$pass = "2004513";
$dbname = "hospital";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
// Set charset
mysqli_set_charset($conn, "utf8");
?>
