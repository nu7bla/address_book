<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "address_book";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    $conn->set_charset("utf8mb4"); // Ensures proper character encoding
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
