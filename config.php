<?php
$conn = new mysqli("localhost", "root", "", "penerimaan");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
